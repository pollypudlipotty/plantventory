//home page image and text animation
$(document).ready(function(){
    if (window.location.href.indexOf('index.php') > -1){ //specifying which document
    $("#img-change").fadeTo(2000, 1);
    $("#img-text").fadeTo(2000, 1);
    $("#img-text").animate({letterSpacing: "+=15px"},1000);
    $("#img-change").delay(1000).fadeTo(2000, 0); 
    $("#img-text").delay(1000).fadeTo(2000, 0, function(){
        $("#img-text").css("letter-spacing", "normal");
        $("#img-change").attr("src","images/img3.jpg");
        $("#img-text").text("Beauty");
        $("#img-change").fadeTo(2000, 1);
        $("#img-text").fadeTo(2000, 1);
        $("#img-text").animate({letterSpacing: "+=15px"},1000);
        $("#img-change").delay(1000).fadeTo(2000, 0); 
        $("#img-text").delay(1000).fadeTo(2000, 0, function(){
            $("#img-text").css("letter-spacing", "normal");
            $("#img-change").attr("src","images/img2.jpg");
            $("#img-text").text("Advocation");
            $("#img-change").fadeTo(2000, 1);
            $("#img-text").fadeTo(2000, 1);
            $("#img-text").animate({letterSpacing: "+=15px"},1000);
            $("#img-text").delay(1000).fadeTo(2000, 0, function(){
                $("#welcome-text").fadeTo(2000,1);
            });
        });
    }); }
});


//registration and login image animation
$(document).ready(function(){
    if ((window.location.href.indexOf('register.php') || (window.location.href.indexOf('login.php')) > -1)){ //specifying which document
    $("#reg-img").fadeTo(4000, 1);}
});

//regstration validation
function validateRegi()
{
    let check = 0;
    
    $("#reg_msg").text(""); //clearing the error message <p>

    //checking if there is any empty input field, giving an error message
    if($("#email").val().length==0 || $("#nick").val().length==0 || $("#pw1").val().length==0 || $("#pw2").val().length==0)
    {
        $("#reg_msg").append("All fields must be filled!");
        
    }
    
    //checking individually the input fields

    if($("#email").val().length==0)
    {
        $("#email_err").text("*").css('color','red');        
    }
    else if(IsEmail($("#email").val()) == false) //regex function for email below
    {
        $("#email_err").text("*").css('color','red');
        $("#reg_msg").append("<br>Email address is not valid.");
    }
    else
    {
        $("#email_err").text("");
        check++;
    }

    if($("#nick").val().length==0)
    {
        $("#nick_err").text("*").css('color','red');        
    }
    else
    {
        $("#nick_err").text(""); 
        check++;
    }

    
    if($("#pw1").val().length==0 || $("#pw2").val().length==0)
    {
        $(".pw_err").text("*").css('color','red');

        $("#pw1").val("");   //clearing out the pw fields when wrong or missing input
        $("#pw2").val("");
    }
    else if($("#pw1").val() != $("#pw2").val())
    {
        $(".pw_err").text("*").css('color','red');
        $("#reg_msg").append("<br>Passwords are not the same.");


        $("#pw1").val("");   //clearing out pw input fields
        $("#pw2").val("");
    }

    if(IsPw($("#pw1").val()) == false)  //checking the criteria with regex function below
    {

        $(".pw_err").text("*").css('color','red');
        $("#reg_msg").append("<br>Password does not match the criteria.");


        $("#pw1").val("");   //clearing out pw input fields
        $("#pw2").val("");
    }
    else
    {
        $(".pw_err").text("");
        check++;
    }

    
    
    
    if(check == 3)
    {       
       
        return true;   
          
    }

    return false;
    
}

//login form validation
function validateLogin()
{
    $("#login_err").text(""); //clearing the error message header
    let check = 0;

    if($("#email").val().length==0)
    {
        $("#e_err").text("*").css('color','red');
        $("#login_err").append("Email address is missing!");      
    }
    else
    {
        $("#e_err").text("");
        check++;
    }

    if($("#pw").val().length==0)
    {
        $("#p_err").text("*").css('color','red');
        $("#login_err").append("<br>Password is missing!"); 
        $("#pw").val("");   //clearing out the pw fields when wrong or missing input
    }
    else
    {
        $("#p_err").text("");
        check++;
    }

    if(check == 2)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

//correct email format checker with regex
function IsEmail(email)
{
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}

//correct pw checker
function IsPw(pw)
{
    var regex = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])([a-zA-Z0-9]{6,10})+$/;  
    if (!regex.test(pw)) {
        return false;
    }
    else {
        return true;
    }

}

//plant sepcies autocomlete in add plant form
$(document).ready(function() {
    if (window.location.href.indexOf('add_new.php') > -1){ //specifying which document
      $('#species').autocomplete({
        source: "types.php"
    });}
  });

//add new plant form validation
function validateNew()
{
    let check = 0;
    today = setToday(); //setting the good format of today for date comparison
    
    $("#new_msg").text(""); //clearing the error message <p>
    

    //checking if there is any empty input field, giving an error message
    if($("#species").val().length==0 || $("#pname").val().length==0 || !($("#since").val()))
    {
        $("#new_msg").append("Please fill out all required fields to continue.");    
        
    }

    if($("#species").val().length==0)
    {
        $("#spc_err").text("*");        
    }
    else
    {
        $("#spc_err").text('');
        check++;
    }

    if($("#pname").val().length==0)
    {
        $("#pname_err").text("*");        
    }
    else
    {
        $("#pname_err").text('');
        check++;
    }

    if(!$("#since").val())
    {
        $("#since_err").text("*");        
    }
    else if($("#since").val() > today)  //checking if given date is in the future
    {
        $("#since_err").text("*");
        $("#new_msg").append("<br>Please only give past dates or today's date."); 
    }
    else
    {
        $("#since_err").text('');
        check++;
    }


    if(check == 3)
    {       
       
        return true;   
          
    }

    return false;
 }

//plant-card info box and info button event control
function cardInfo(cardnumber)
{
    let plantid = "#card-note-"+cardnumber;
    let buttonid = "#infobtn-"+cardnumber;

    if($(plantid).css('display') == 'none')
    {
        $(plantid).css("display","block");
        $(buttonid).text("Hide");
        $(buttonid).css("background-color","rgb(55, 190, 121);");
        $(buttonid).css("border"," 2px solid black;");
    }
    else
    {
        $(plantid).css("display","none");
        $(buttonid).text("Info");
    }
}

//edit plant form validation
function validateEdit()
{  

    let check = 0;

    today = setToday();
    
    $("#edit_msg").text(""); //clearing the error message <p>
    

    //checking if there is any empty input field, giving an error message
    if($("#e-pname").val().length==0 || !($("#e-since").val()))
    {
        $("#edit_msg").append("Please fill out all required fields to continue.");    
        
    }


    if($("#e-pname").val().length==0)
    {
        $("#e-pname_err").text("*");        
    }
    else
    {
        $("#e-pname_err").text('');
        check++;
    }

    if(!$("#e-since").val())
    {
        $("#e-since_err").text("*");        
    }
    else if($("#e-since").val() > today)  //checking if given date is in the future
    {
        $("#e-since_err").text("*");
        $("#edit_msg").append("<br>Please only give past dates or today's date."); 
    }
    else
    {
        $("#e-since_err").text('');
        check++;
    }


    if(check == 2)
    {       
       
        return true;   
          
    }

    return false;
}

//creating a date format which can be compared with input date in validation functions
function setToday()
{
     const now = new Date(); //gets now to milliseconds
     const year = now.getFullYear(); 
     const month = now.getMonth() + 1; //because getMonth() starts from 0
     const day = now.getDate();
 
     const today = year+"-"+month+"-"+day; //creating the right date format

     return today;
}

//code to display the selected file name in add_picture.php
$(document).ready(function(){
    if (window.location.href.indexOf('add_picture.php') > -1){ //specifying which document
    document.getElementById('fileInput').addEventListener('change', function() {
    var file_name = this.value.split('\\').pop();
    $("#f_name_show").attr('placeholder', file_name); 
    });}
})

//form validation for adding new image
function validImgForm()
{
    let check = 0;
    
    $("#img_msg").text(""); //clearing the error message <p>    

    //checking if there is any empty input field, giving an error message
    if($("#caption").val().length==0 || $("#f_name_show").attr('placeholder') == "No file selected.")
    {
        $("#img_msg").append("All fields must be filled!");  
    }
    else
    {
        check++;
    }

    if($("#caption").val().length >= 149)
    {
        $("#img_msg").append("<br>Caption is too long.");    
    }
    else
    {
        check++;
    }

    if(check == 2)
    {
        return true;
    }
    else
    {
        return false;
    }

}

//edit picture validation
function validEditPic()
{
    let check = 0;
    $("#edit_pic_msg").text(""); //clearing the error message <p>    

    //checking if caption is empty
    if($("#e-cap").val().length==0)
    {
        $("#edit_pic_msg").append("Caption is required!");  
    }
    else
    {
        check++;
    }
   
    //checking if caption is too long
    if($("#e-cap").val().length >= 149)
    {
        $("#edit_pic_msg").append("<br>Caption can not be longer then 150 characters.");    
    }
    else
    {
        check++;
    }

    if(check == 2)
    {
        return true;
    }
    else
    {
        return false;
    }

}

function openPic(img_path)
{
    $('#big_pic').attr('src', img_path);
    $('#myModal').css('display','block');    
}

function closePic()
{
    $('#myModal').css('display','none'); 
}

