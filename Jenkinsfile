pipeline {
	agent any
  stages {
  	stage('Build') {
        steps {
            echo "Build stage complete"
        }
    }
  }
	post {
		always {
			mail to: 'shurikip2017@gmail.com',
				subject: "Status of pipeline: ${currentBuild.fullDisplayName}",
				body: "${env.BUILD_URL} has result ${currentBuild.result}"
		}
	}
}
