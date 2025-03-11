pipeline {
    agent any

    environment {
        COMPOSER_HOME = '/usr/local/bin/composer'
        DOCKER_REGISTRY = 'your-docker-registry'
        DOCKER_IMAGE = 'your-image-name'
        ARTIFACT_REPO_LOCAL = 'your-local-repository-url'
        ARTIFACT_REPO_PUBLIC = 'your-public-repository-url'
        STAGING_REGISTRY = 'your-staging-registry-url'
        PROD_REGISTRY = 'your-prod-registry-url'
    }

    stages {

        stage('Checkout') {
            steps {
                checkout([$class: 'GitSCM',
                          branches: [[name: '*/main']],
                          userRemoteConfigs: [[url: 'https://github.com/brayadev/GestionEtablissement.git']]])
            }
        }

        stage('Install Dependencies') {
            steps {
                sh '/usr/local/bin/composer install --no-interaction --prefer-dist'
            }
        }

        stage('Prepare Database') {
            steps {
                sh 'mkdir -p "/var/jenkins_home/workspace/Gestion pipeline/database"'
                sh 'touch "/var/jenkins_home/workspace/Gestion pipeline/database/database.sqlite"'
                sh 'chmod 775 "/var/jenkins_home/workspace/Gestion pipeline/database"'
            }
        }

        stage('Run Migrations') {
            steps {
                sh 'php artisan migrate --force'
            }
        }

        stage('Run Unit Tests') {
            steps {
                sh './vendor/bin/phpunit --configuration phpunit.xml'
            }
        }

        stage('Run IHM Tests') {
            steps {
                // Ajouter ici la commande pour exécuter les tests IHM (par exemple, avec Cypress ou Selenium)
                // Exemple:
                // sh 'npx cypress run'
            }
        }

        stage('Quality Check') {
            steps {
                // Ajouter l'outil de vérification de qualité (exemple: PHPStan, SonarQube, etc.)
                // Exemple:
                // sh 'phpstan analyse'
                // Ou intégrer SonarQube avec Jenkins
            }
        }

        stage('Package Artifacts') {
            steps {
                // Vous pouvez packager l'artefact ici (ex. avec Composer ou un outil adapté)
                sh 'composer archive --format=tar --filename=artifact.tar'
                // Vous pouvez également utiliser une autre méthode de packaging, comme npm ou Maven pour le front-end ou autres
            }
        }

        stage('Build Docker Image') {
            steps {
                sh "docker build -t ${DOCKER_IMAGE}:latest ."
            }
        }

        stage('Push Docker Image to Registry') {
            steps {
                script {
                    if (env.BRANCH_NAME == 'main') {
                        // Déploiement en préprod et prod (Push vers un registre distant)
                        sh "docker tag ${DOCKER_IMAGE}:latest ${PROD_REGISTRY}/${DOCKER_IMAGE}:latest"
                        sh "docker push ${PROD_REGISTRY}/${DOCKER_IMAGE}:latest"
                    } else {
                        // Déploiement en dev et staging (Push vers un registre local)
                        sh "docker tag ${DOCKER_IMAGE}:latest ${STAGING_REGISTRY}/${DOCKER_IMAGE}:latest"
                        sh "docker push ${STAGING_REGISTRY}/${DOCKER_IMAGE}:latest"
                    }
                }
            }
        }

        stage('Upload Artifacts to Repository') {
            steps {
                script {
                    if (env.BRANCH_NAME == 'main') {
                        // Upload to public repository for preprod/prod
                        sh "curl -u username:password -X POST -F 'file=@artifact.tar' ${ARTIFACT_REPO_PUBLIC}"
                    } else {
                        // Upload to local repository for dev/staging
                        sh "curl -u username:password -X POST -F 'file=@artifact.tar' ${ARTIFACT_REPO_LOCAL}"
                    }
                }
            }
        }

        stage('Provision Target Environment') {
            steps {
                // Provisioning automatique (ex. avec Ansible, Terraform, ou autre)
                // Exemple:
                // sh 'ansible-playbook -i inventory/hosts provision.yml'
            }
        }

        stage('Deploy to Target Environment') {
            steps {
                script {
                    if (env.BRANCH_NAME == 'main') {
                        // Déploiement en préprod et prod
                        sh "kubectl apply -f k8s/prod/deployment.yaml"
                    } else {
                        // Déploiement en dev et staging
                        sh "kubectl apply -f k8s/staging/deployment.yaml"
                    }
                }
            }
        }
    }

    post {
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
