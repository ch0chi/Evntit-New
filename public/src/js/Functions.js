
$(window).scroll(function() {

});

var lastScrollTop = 0;
if($('.navbar-default').hasClass('solid-bg')){
    //do nothing
}else{
    $(window).scroll(function(event){
        var st = $(this).scrollTop();

        if (st > lastScrollTop){
            $('.navbar-default').addClass('scroll');
            $('.navbar-nav>li>a').animate().addClass('navbarLiScroll');
            $('.navbar>.container .navbar-brand').animate().addClass('navbarLiScroll');
        }if(st <= 10) {

            $('.navbar-default').removeClass('scroll');
            $('.navbar-nav>li>a').removeClass('navbarLiScroll');
            $('.navbar>.container .navbar-brand').animate().removeClass('navbarLiScroll');
        }
        lastScrollTop = st;
    });
}




/**
 * Image Class
 *
 */
//dynamically add image
var img = document.createElement("img");

function Image(){
    //Image constructor
}

//Dynamically display image
Image.prototype.displayImage = function(){
    $("#event_image").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div

                $(".formImage").css({
                    "background-image":"url("+this.result+")",
                    "background-size":"cover",
                    "background-position":"center"
                });
                image.getSrc(this.result);
            }
        }
    });
};

Image.prototype.getSrc = function(source){
    img.src=source;
};

function Event(){

}

Event.prototype.comment = function(){

};
$('#addComment').click(function(e){
    e.preventDefault();
    $('#spinner').show();
    var comment = $(this).closest("form").find("input[name='body']").val();
    var event = $(this).closest("form").find("input[name='event_id']").val();
    var avatar = $(this).closest("form").find("input[name='avatar']").val();
    var name = $(this).closest("form").find("input[name='name']").val();
    var fb_id = $(this).closest("form").find("input[name='fb_id']").val();
    $.ajax({
        url: '/comment/submit_comment',
        type: 'POST',
        data: {'body': comment, 'event_id': event, '_token': $('input[name=_token]').val()},
        success: function () {
            $('#spinner').hide();
            console.log("<a href=\'https://facebook.com/"+fb_id+"\'><img src="+avatar+" height=\"15px\" width=\"15px\"><span class=\"eventCardUserName\">"+name+"</span></a>");
            $('.comments').append("<a href=\'https://facebook.com/"+fb_id+"\'><img src="+avatar+" height=\"15px\" width=\"15px\"><span class=\"eventCardUserName\">"+name+"</span></a> "
            +comment+"<br>"
            );
            $("input[name='body']").val('');
        }

    });
    return false;
});

//call ajax event signup
$('#event_signup').click(function(e){
    e.preventDefault();
    $('#spinner').show();
    var userID = $("input[name='user_id']").val();
    var eventKey = fetchKey();
    $.ajax({
        url:'/event/signup/',
        type:'POST',
        data:{'eventKey':eventKey,'user_id':userID,'_token':$('input[name=_token]').val()},
        success: function(){
            $('#spinner').hide();
            $('#signupSuccess').modal('show');
        },
        error: function(err){
            console.log(err);
            $('#spinner').hide();
            $('#signupError').show().html('<p>You\'re already signed up for this event!</p>');
            console.log("Looks like you've already registered!");
        }
    })
});


/*Test Pusher class*/
(function(){
    var pusher = new Pusher('b1cdb4c1ac9f68e794e4',{
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('demoChannel');

    channel.bind('userLikedPost',function(data){
        alert('a user liked this post!');
    });
})();


/**
 * returns the users geolocation
 *
 *
 */
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
}

/**
 * @func geoplugin_city() returns the users city
 * @func geoplugin_region() returns the users state
 *
 * sets the div district to the users city and state
 */
var district = geoplugin_city();
var region = geoplugin_region();

$("#locationSearch").val(district+","+" "+region);


//Helper functions
function fetchKey(){
    var path = window.location.pathname.split('/');
    return path[2];
}


var image = new Image();
//var comment = new Comment();
function initialize(){
    image.displayImage();


}


//initialize functions
initialize();


//temporarily disables non-working dashboard links

