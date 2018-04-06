###################
Mailerlite Developer Test

created by Adedayo Akinpelu <adedayoakinpelu@gmail.com>
###################

One of the the most basic and key features of MailerLite is managing subscribers. Someone needs to receive your beautiful newsletters created on MailerLite so you need to have a great way to handle that data. There are a few different ways how it can be achieved:

"Add subscriber" form in our web app
Public HTTP API endpoint
Custom and unique web form or landing page
Other services which are integrated with MailerLite using our API

All the ways mentioned above are based on using a single service dedicated to the management of subscribers.


*******************
Task
*******************

Your task is to create an HTTP API backend service for two resources and their relations: subscribers and fields.

Resources

Subscriber's resource should contain those fields at least: email address, name, state (active, unsubscribed, junk, bounced, unconfirmed).
Field's resource should contain those fields at least: title, type (date, number, string, boolean).
Each subscriber can have many fields.


##################################################
Instructions on how to run the solution proferred
##################################################


*******************
Setting up Manually
*******************


***********************************************************************************************
1. Clone the repo to your local environment 
    `git clone https://github.com/haroldsphinx/developertestassignment.git`
2. Create a database name and set the Configuration in your your database settings 'application/config/database.php'
3. run `php index.php tools migrate` to migrate the schema into your database
4. run  ` php index.php tools seed SubscriberssSeeder &&  php index.php tools seed FieldSeeder` to populate your database with sample data
5. configure your base url in the config folder `application/config/config.php`, you can also set it as environment varaibles in your nginx/apache config
6. Access your base_url from the browser and you should get a json response.
***********************************************************************************************


######################################################################################################################################################
In the Application Folder, I attached a postman collection to make it easy for you to access the resources
######################################################################################################################################################








######################################################################################################################################################
If you are not comfortable with the postman collection, this is a simple api documentation you can relate with
######################################################################################################################################################


**Title**
----
  <A simple API to demonstrate working with Subscriber anf Field Resource on Mailerlite>

* **URL**

  <Based on the config_base_url you configured, your api url should like this  `localhost/developertestassignment/`>

* **Method:**
  
  <_The request type_>

  `GET` | `POST` 
  
*  **URL Params**

   /**
     * Subscriber Resource Endpoint
     * @param email_address
     * @param name
     * @param lastname
     * @param state
     * @param company
     * @param country
     * @param city
     * @param state
     * @param zip
     * @param phone_number
     * @param state_of_origin
     *
     **/

   **Required Fields:**
    * @param email_address
    * @param name
    * @param state <state here, is the subscriber details state>

   `email_address=Must be Valid`

   **Optional:**
 
   `lastname=[text]`
   `company=[text]`
   `country=[alphanumeric]`
   `phone_number=[alphanumeric]`
   `state_of_origin=[alphanumeric]`
   `zip=[integer]`


* **Data Params**

  <_When making a post request, your json data should like this._>

            $subscriber_data = array(
                    'email_address' => "johndoe@company.com",
                    'name' => "John Doe",
                    'state' => "Active",
                    'lastname' => "Doe",
                    'company' => "Company Name",
                    'country' => "Country",
                    'city' => "London",
                    'zip' => "234",
                    'phone_number' => "323-43434343"
                    'state_of_origin' => "Ottawa"
                );

* **Success Response:**
  
  <_A success response from the api will llok like this_>

  {
    "status": true,
    "response": {
        "error": false,
        "message": "Status Message",
        "data": []
    }
  }

  * **Code:** 200 <br />
    **Content:** `{ id : 12 }`
 
* **Error Response:**

  <_An error response from the api will look like this._>

   {
    "status": true,
    "response": {
        "error": true,
        "message": "Error Message"
      
    }
  }
  OR

  

################################
The available http methods are
###############################

*********************
Subscriber Resource:
**********************

Get All Subscribers - `http://localhost/Mailerlite/` => Method - GET 

Get One subscriber with id - `http://localhost/Mailerlite/subscriber` => Method - GET => params -> {'id'=>'1'}

Add a new Subscriber - `http://localhost/Mailerlite/` => Method - POST => params -> <check subscriber data as mentioned earlier>

Update an existing Subscriber - `http://localhost/Mailerlite/edit_subscriber_post` => Method - POST => params -> <check subscriber data as mentioned earlier, then include the sibscriber id you wish to modify>

Delete an existing Subscriber - `http://localhost/Mailerlite/delete_subscriber` => Method - GET => params -> {'id'=>'1'}



*********************
Field Resource:
**********************

Get All Field - `http://localhost/Mailerlite/field` => Method - GET 

Get One Field with id - `http://localhost/Mailerlite/field/get_field_by_id` => Method - GET => params -> {'id'=>'1'}

Add a new Field - `http://localhost/Mailerlite/` => Method - POST => params -> <check subscriber data as mentioned earlier>

Update an existing Field - `http://localhost/Mailerlite/edit_field` => Method - POST => params -> <check subscriber data as mentioned earlier, then include the sibscriber id you wish to modify>

Delete an existing Field - `http://localhost/Mailerlite/delete_field` => Method - GET => params -> {'id'=>'1'}

