pipeline {
    agent any

    environment {
        COMPOSER_HOME = '/usr/local/bin/composer'
    }

    stages {
        stage('Install Composer') {
             steps {
                    bat '''
                        where composer || (
                            echo Composer not found, installing...
                            php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                            php composer-setup.php
                            del composer-setup.php
                            move composer.phar C:\\Windows\\System32\\composer.exe
                        )
                    }'''
            }
        }

        stage('Checkout') {
            steps {
                script {
                    checkout([$class: 'GitSCM',
                              branches: [[name: '*/main']],
                              userRemoteConfigs: [[url: 'https://github.com/brayadev/GestionEtablissement.git']]
                    ])
                }
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

        stage('Database Migrations') {
            steps {
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
