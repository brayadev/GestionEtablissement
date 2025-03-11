pipeline {
    agent any

    environment {
        COMPOSER_HOME = '/usr/local/bin/composer'
    }

    stages {
        stage('Install Composer') {
            steps {
                sh '''
                if ! [ -x "$(command -v composer)" ]; then
                    echo "Composer not found, installing..."
                     # Installer wget si non présent
                                if ! command -v wget &> /dev/null; then
                                    echo "Installing wget..."
                                    sudo apt-get update && sudo apt-get install -y wget
                                fi
                    EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
                    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                    ACTUAL_SIGNATURE=$(php -r "echo hash_file('sha384', 'composer-setup.php');")

                    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
                        echo 'ERROR: Invalid Composer installer signature'
                        rm composer-setup.php
                        exit 1
                    fi

                    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
                    rm composer-setup.php
                else
                    echo "Composer is already installed."
                fi
                '''
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
