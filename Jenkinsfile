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
                sh 'export PATH=$PATH:/usr/local/bin && composer install --no-interaction --prefer-dist'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    sh 'composer run-script sonar'
                }
            }
        }

        stage('Run Tests') {
            steps {
                sh './vendor/bin/phpunit --configuration phpunit.xml'
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
