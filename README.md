1. create project directory
2. extract symfony lib under lib/vendor/ 
3. Run the command to generate symfony 1.4 project
	php lib/vendor/symfony/data/bin/symfony generate:project <PROJECT_NAME>
4. Set up vhost and host entry. If rewrite mode is not enabled, please enable it (in ubuntu use sudo a2enmod rewrite)
	vhost template :
		<VirtualHost *:80>
		  DocumentRoot /Users/shaduli/studies/training/web
		  DirectoryIndex index.php
		  ServerName training.ali 
		  <Directory /Users/shaduli/studies/training/web/>
		     Options Indexes FollowSymLinks MultiViews
		     AllowOverride All
		     Order allow,deny
		     allow from all
		  </Directory>

		  Alias /sf /Users/shaduli/studies/training/lib/vendor/symfony/data/web/sf
		  <Directory /Users/shaduli/studies/training/lib/vendor/symfony/data/web/sf>
		    AllowOverride All
		    Allow from All
		  </Directory>
		</VirtualHost>
		
5. Set up the permission requirements for symfony 
	./symfony project:permissions
	
6. Configure the database
	./symfony configure:database mysql:"host=<HOST_NAME>;dbname=<DB_NAME>" <MYSQL_USER> <PASSWORD>
	
7. Create the application 
	./symfony generate:app <APP_NAME>
	
8. Create the models in schema.yml
	templates:
		Category:
		  actAs: { Timestampable }
		  columns:
		    name: {type: string(255), notblank: true }
		#post model
		Post:
		  actAs: { Timestampable }
		  columns:
		    title: {type: string(255), notblank: true }
		    body: {type: text, notblank: true, minlength: 50 }
		    author: {type: string(255), notblank: true }
		    is_approved: {type: boolean, default: false }
		    category_id: {type: integer, notnull: true }
		  relations:
		    Category: { class: Category, local: category_id, foreign: id, type: one , foreignType: many, foreignAlias: Posts, onDelete: CASCADE  }

9. Generate the model classes:
	./symfony doctrine:build --model
	
10. Generate the form classes:
	./symfony doctrine:build --forms
11. Generate filter classes
	./symfony doctrine:build --filters
	
12. Create the sql for databasde and insert in db
		./symfony doctrine:build-sql  
	    ./symfony doctrine:insert-sql
	
		Note: Steps 9-12 can be done in a single command:  ./symfony doctrine:build --all . But it is dangerous to run in live or existing system
		
13. Install and Configure sfDoctrineGuardPlugin from http://www.symfony-project.org/plugins/sfDoctrineGuardPlugin

14. create user by using the command : ./symfony guard:create-user --is-super-admin <EMAIL> <USERNAME> <PASSWORD> <FIRST_NAME> <LAST_NAME>

15. Install and configure jroller theme plugin http://www.symfony-project.org/plugins/sfAdminThemejRollerPlugin

16. You can create backend modules using ./symfony doctrine:generate-admin <BACKEND_APP> --module="<MODUEL_NAME>" <MODEL or ROUTE>


	

	
