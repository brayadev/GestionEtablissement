pipeline {
    agent any

    environment {
        COMPOSER_HOME = '/usr/local/bin/composer'
    }

    stages {

        stage('Checkout') {
            steps {
                checkout([$class: 'GitSCM',
                          branches: [[name: '*/main']],
                          userRemoteConfigs: [[url: 'https://github.com/brayadev/GestionEtablissement.git']]
                ])
            }
        }

        stage('Install Dependencies') {
            steps {
                sh '/usr/local/bin/composer install --no-interaction --prefer-dist'
            }
        }

        stage('Prepare Database') {
            steps {
                // Créer le répertoire 'database' s'il n'existe pas
                sh 'mkdir -p "/var/jenkins_home/workspace/Gestion pipeline/database"'
                // Créer la base de données SQLite si elle n'existe pas
                sh 'touch "/var/jenkins_home/workspace/Gestion pipeline/database/database.sqlite"'
                // Donner les bonnes permissions
                sh 'chmod 775 "/var/jenkins_home/workspace/Gestion pipeline/database"'
            }
        }

        stage('Run Migrations') {
            steps {
                // Exécuter les migrations
                sh 'php artisan migrate --force'
            }
        }

        stage('Generate APP_KEY') {
            steps {
                sh 'php artisan key:generate --env=testing'
            }
        }

        stage('Run Tests') {
            steps {
                // Lancer les tests PHPUnit
                sh './vendor/bin/phpunit --configuration phpunit.xml'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh "docker build -t ${DOCKER_IMAGE}:latest ."
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
