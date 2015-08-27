<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js">
</script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $.get('/maps/signPage',function(res){
     $('.form').html(res);
    });
  });
</script>
<style type="text/css">

      html, body,.googleMap {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #container {
        height: 100%;
        width: 100%;
        background-color: silver;
    
      }
       .firstHeading {
        top: 0 !important;
        left: 0 !important;
        border-radius: 5px 5px 0 0;
     }
     #firstHeading .firstHeading h1{
      width: 400px;
     }
      #content .firstHeading {
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 22px;
        font-weight: 400;
        padding: 10px;
        background-color: #48b5e9;
        color: white;
        margin: 0px;
        border-radius: 5px 5px 0 0;
      }
      .name {
        font-size: 18px;
        font-family: "Courier New", Courier, monospace;
        font-weight: bold;
        text-align: left;
      }
      .comment {
        font-family: "Lucida Console", Monaco, monospace;
        text-align: left;
      }
      #googleMap {
        margin: 0 auto;
        margin-top: 20px;
        border: 2px solid gray;
        border-radius: 100px;
      }
      input{
        width: 300px;
      }
</style>
</head>
 
<body>
<div id='container'>       
<div class="form"></div>         
<div id="googleMap" style="width:70%;height:500px;"></div>
<div class="userTable">

    
</div>

<a href="/maps/logout"><button>Logout</button></a>
<script>
var infoW=[];
function closeW(){
  for (var i = 0; i < infoW.length; i++) {
    infoW[i].close();
  };
}
var icon2="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
var icon1="http://maps.google.com/mapfiles/ms/icons/blue-dot.png";


 var comments=<?php echo json_encode($comments); ?>;
 var locations=<?php echo json_encode($locations); ?>;
 var users=<?php echo json_encode($users); ?>;
 var logUser=<?php 
 if ( $this->session->userdata('user_info')!==null ) {
    echo json_encode($this->session->userdata('user_info')['id']);
 };
  ?>;

 
 //var string="string";
function initialize(array,array2)
{
        var mapProp = {
        center:{lat: 18.9543, lng: 16.1818},
         zoom:2,
         mapTypeId: google.maps.MapTypeId.ROADMAP
        };
       
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var arr = [];
        for (var i = 0; i < array.length; i++){
        var myC=new google.maps.LatLng(array[i]['lng'], array[i]['lat']);
        var marker=new google.maps.Marker({
          id: array[i]['id'],
          city: array[i]['city'],
          position:myC,
          icon:icon1
          });

        arr.push(marker);
        }

for (var i = 0; i < array.length; i++)
{
 
  arr[i].setMap(map);
  google.maps.event.addListener(arr[i], 'click', function() {
    // alert($(this).attr("id"));
    console.log()
    var com=" ";
    var user="<p>";
    var loc=" ";
    for (var i = 0; i < comments.length; i++) {
      if (comments[i]['location_id']==$(this).attr('id')) {
        com+="<p class='comment'>"+comments[i]['name']+" :: "+comments[i]['comment']+"</p>";
      };

    };
    for (var i = 0; i < users.length; i++) {
      if (users[i]['location_id']==$(this).attr('id')) {
        user+= "<span class='name'>" + users[i]['name']+"   |   " + "</span>";
      };
  };
    for (var i = 0; i < locations.length; i++) {
      if (locations[i]['id']==$(this).attr('id')) {
        loc=locations[i]['url'];
      };
    };
    user+="</p>";
    console.log($(this).attr('id'));
 if (logUser!==null) {
    var form="<form action='/maps/add_comment' method='post'><input type='text' name='comment'><input type='hidden' name='location_id' value="+$(this).attr('id')+"><input type='hidden' name='user_id' value="+logUser+"><input type='submit' value='add Comment'></form>"
  }
  else{
    var form=" ";
  }
    var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      "<h1 width='400px' class='firstHeading'>"+$(this).attr('city')+"</h1>"+
      '<div id="bodyContent">'+ "<img width='400px' height='170px' src="+loc+">" +
      user+com+form+
      '</div>'+
      '</div>';
   var infowindow = new google.maps.InfoWindow({
      content: contentString,
      position: $(this).attr("position")
  });
   infoW.push(infowindow);
   closeW();
     infowindow.open(map );
     
    map.setCenter($(this).attr("position"));
     map.setZoom(5);
  });
 
}
       
}
 
 
google.maps.event.addDomListener(window, 'load', initialize(
        <?php echo json_encode($locations); ?>
        ));
google.maps.event.addListener(marker, 'mouseover', function() {
    marker.setIcon(icon2);
});
google.maps.event.addListener(marker, 'mouseout', function() {
    marker.setIcon(icon1);
});
</script>

</div>
</body>
</html>