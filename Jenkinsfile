pipeline {
    agent any

    environment {
        COMPOSER_HOME = '/usr/local/bin/composer'
    }

    stages {
        stage('Install Composer') {
            steps {
                sh '''
                    if ! command -v composer &> /dev/null
                    then
                        echo "Composer not found, installing..."
                        apt-get update && apt-get install -y wget php-cli unzip
                        wget -O composer-setup.php https://getcomposer.org/installer
                        php composer-setup.php --install-dir=/usr/local/bin --filename=composer
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
