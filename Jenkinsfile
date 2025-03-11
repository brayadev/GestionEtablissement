pipeline {
    agent any

    environment {
        // Configurer les variables d'environnement nécessaires
        COMPOSER_HOME = '/usr/local/bin/composer'  // Vérifie si Composer est installé
    }

    stages {
        stage('Checkout') {
            steps {
                // Récupérer le code source depuis le dépôt Git
                git 'https://github.com/brayadev/GestionEtablissement.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                // Installer les dépendances avec Composer
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                // Analyser le projet avec SonarQube
                withSonarQubeEnv('SonarQube') {
                    sh 'composer run-script sonar'
                }
            }
        }

        stage('Run Tests') {
            steps {
                // Lancer les tests avec PHPUnit
                sh './vendor/bin/phpunit --configuration phpunit.xml'
            }
        }

        stage('Database Migrations') {
            steps {
                // Appliquer les migrations Laravel (si nécessaire)
                sh 'php artisan migrate --force'
            }
        }
    }

    post {
        success {
            echo 'Build, tests, and analysis completed successfully!'
        }
        failure {
            echo 'Build failed!'
        }
    }
}
