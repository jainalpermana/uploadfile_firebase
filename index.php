<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Lokasi ATM BNI</title>
	<style media="screen">
		body{

			display: flex;
			min-height: 100vh;
			width: 100%
			padding:0;
			margin: 0;
			align-items: center;
			justify-content: center;
			flex-direction: column;	
		}

		#uploader{
			-webkit-appearance: none;
			appearance:none;
			width: 50%;
			margin-bottom: 10px;
		}

	</style>

</head>
<body>

	Silahkan Upload Foto Lokasi
<progress value="0" max="100" id="uploader">0%</progress>
<input type="file" value="upload" id="fileButton" >
<br>

<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBx9HYxUMvh_RdP9N0PcLoQgS7WSk8vTMc",
    authDomain: "web-quickstart-19beb.firebaseapp.com",
    databaseURL: "https://web-quickstart-19beb.firebaseio.com",
    projectId: "web-quickstart-19beb",
    storageBucket: "web-quickstart-19beb.appspot.com",
    messagingSenderId: "170974178445"
  };
  firebase.initializeApp(config);
</script>

<script type="text/javascript">
	//get element
	var uploader = document.getElementById('uploader');
	var fileButton = document.getElementById('fileButton');

	//listen file selection
	fileButton.addEventListener('change', function(e) {
	
	//get file
	var file = e.target.files[0];
	
	//create a storage ref
	var storageRef = firebase.storage().ref('sweet_gifs/' + file.name);

	//upload file
     var task = storageRef.put(file);

     //update progress bar
     task.on('state_changed',
     	function progress(snapshot){
     		var percentage = (snapshot.bytesTransferred/ snapshot.totalBytes) * 100;
     		uploader.value = percentage;

     	},

     	function eror(err){

     	},

     	function complete(){

     	}

     	);

	});

//CREATE	

//Get elements
var preLokasi = document.getElementById('lokasi');
var ulList = document.getElementById('list');

//create references
var dbRefLokasi = firebase.database().ref().child('lokasi');
var dbRefList = dbRefLokasi.child('namalokasi');

//Sync object changes
dbRefLokasi.on('value', snap=> {
  preLokasi.innerText = JSON.stringify(snap.val(), null, 3);


//Sync list changes
dbRefList.on('child_added', snap => {

var li = document.createElement('li');
li.innerText = snap.val();
li.id = snap.key;
ulList.appendChild(li);


});

dbRefList.on('child_changed', snap => {

  var liChanged = document.getElementById(snap.key);
  liChanged.innerText = snap.val();

});

dbRefList.on('child_removed', snap => {

  var liRemove = document.getElementById(snap.key);
  liToRemove.remove();

});

//menampilkan foto pada web admin
	


});




</script>

<pre id="lokasi">
	
</pre>

<ul id="list">
	
</ul>
	
</body>
</html>


