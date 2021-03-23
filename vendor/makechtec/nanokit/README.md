
# Documentation for PageManager Project

### 1. Form Validations

In the html file for the form use the **contactform** id.  
also include an element ( usually a div ) with the **serverResponse** id  
it show the text response script. Finally add the **your** prefix for all  
the paramenter to send as convention.

<form id="contactform">
    <input name="yourname">
</form>
<div id="serverResponse"></div>

at the end of contact form file you should add the addFormJs function

` <?php addFormJs(); ?> `

automatically it calls the jquery.js, jquery-validate.js, axios.js and form.js files.

### send.php File

In the send file you can add a custom key for each param sended from the contact form,  
then it will be enable in the template email file. 

` fp( 'name', 'yourname' ); `

### Template Email

In the template file to use you can catch the values with the custom added key for each one  
in the `$params` array.

<div>
    <?php echo( $params[ 'name' ] ); ?>
</div>

### Custom succes, error messages.

In the site.config.php file you add the selected email template path, the subject and the error, success message.
