# HOW TO EDIT THE DATABASE SCHEMA
# Author: Jared

# To edit the database you need to install MySQL Workbench.

INSTALL NOTES:
	http://dev.mysql.com/downloads/workbench/
	You may need to install the dependencies (on website)
	It's a local program, not on the server.
	It is free and you do NOT have to create an account
	
SETUP/USAGE NOTES:
	Connecting to server:
		Database->Manage Connections'
			Make a connection name to save it
			Standard (TCP/IP) over SSH
			SSH Hostname: globobug.com
			SSH Username: [your ssh username]
			SSH Password: Store in Vault->[your ssh password]
			Username: [your mysql username (same as phpmyadmin)]
			Password: Store in Vault->[your mysql password]
			Default Schema: www_hvzatfsu
		Be sure to test it
		It will be on your homepage now
		
	Adding the model:
		File->Open Model
			Path: ~\Dropbox\hvzWebsite\app\schemas\www_hvzatfsu.mwb
		Should be fine to save if you are the only one with it open
		It will be on your homepage now
		
	Updating the server with the model:
		Open the model
		Database->Syncronize Model
			Choose my server
			Other defaults should be fine
			Pay attention to what you are doing in "Select changes to Apply"
			Follow the prompts, its pretty simple
		You can check it in a server connection
		
	Updating the model with the server:
		Open server connection
		Database->Reverse Engineer
			Follow prompts
			Just select www_hvzatfsu
		You don't need to do this, I did already. Just use the model on Dropbox
		
	Pushing new model to server:
		Open the model
		Database->Forward Engineer
			Follow prompts
		Only mysql admins can do this. (me)
		
OTHER NOTES:
	-Okay so just don't connect to the database yet because I need to make user accounts on my server. Just tell me if you need to update the schema to the server. You can still do everything else, like edit the model on dropbox. 
	-The EER Diagram is where our diagram of the database will be
	-I'm not sure about how objects (rows) are stored in this, if at all
	-When you update be sure not to wipe the data.
		-you can on accident if you delete the table/col that has data
		-I think you can map data in the sync wizard