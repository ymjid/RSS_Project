   function readarticle(id, user){
   		//var item = article;//
   		var itemid = id;
   		var numuser = user;
		$.ajax({
   			type: "POST",
   			url: "./js/ajax/readitem.php",
   			data: {numitem : itemid, nuser : numuser},
   			success: function(data){
   				//alert(data);//
   				document.getElementsByName(id)[0].style.display = "none";
   			}
 		});
   } 
   
   	   function editflux (fluxchange, fluxid, user, fname=""){
   		var fluxaction = fluxchange;
   		var flux = fluxid;
   		var fluxname = fname;
   		var userid = user;
		$.ajax({
   			type: "POST",
   			url: "./js/ajax/editflux.php",
   			data: {setaction : fluxaction, numflux : flux, numuser : userid, namef : fluxname},
   			success: function(data){
   				//alert(data);//
   			}
 		});
   	 } 
   
   function restrictflux(fluxid){
   			var fluxes = document.getElementById("fluxes").getElementsByTagName("div");
  			 for (flux in fluxes) {
      			if ((fluxes[flux].id) && (fluxes[flux].id.substr(0, 4) == "flux")) {
         			if (fluxes[flux].id == 'flux_' + fluxid || fluxid=="0")
            			fluxes[flux].style.display = "";
         			else
            			fluxes[flux].style.display = "none";
      			}
   			}
   } 
   
   function switchlog () {
   	if (document.getElementById("switchtxt1a").style.display ==""){
   		   	document.getElementById("switchtype").value = "Register";
   		   	document.getElementById("switchnum").value = "1";
   			document.getElementById("switchtxt1a").style.display = "none";
   			document.getElementById("switchtxt2a").style.display = "";
   			document.getElementById("switchtxt1b").style.display = "none";
   			document.getElementById("switchtxt2b").style.display = "";
   			document.getElementById("txt1").style.display = "none";
   			document.getElementById("txt2").style.display = "";
   			document.getElementById("sendbutton").value = "Login";
   	}
   	else {
   		   	document.getElementById("switchtype").value = "Login";
   		   	document.getElementById("switchnum").value = "0";
   			document.getElementById("switchtxt1a").style.display = "";
   			document.getElementById("switchtxt2a").style.display = "none";
   			document.getElementById("switchtxt1b").style.display = "";
   			document.getElementById("switchtxt2b").style.display = "none";
   			document.getElementById("txt2").style.display = "none";
   			document.getElementById("txt1").style.display = "";
   			document.getElementById("sendbutton").value = "Create account";
   	}
   }
   function switchimg(imgid){
   	switch (imgid){
   		case home : 
   			document.getElementById("home").src = "./img/home1.png";
   			break;
   		case news : 
   			document.getElementById("news").src = "./img/news1.png";
   			break;
   		case archive : 
   			document.getElementById("archive").src = "./img/archive1.png";
   			break;
   		case flux : 
   			document.getElementById("flux").src = "./img/flux1.png";
   			break;
   		case logout : 
   			document.getElementById("logout").src = "./img/logout1.png";
   			break;
   		default:
   	}
   		


   }
   function switchbackimg(imgid){
   	switch (imgid){
   		case home : 
   			document.getElementById("home").src = "./img/home2.png";
   			break;
   		case news : 
   			document.getElementById("news").src = "./img/news2.png";
   			break;
   		case archive : 
   			document.getElementById("archive").src = "./img/archive2.png";
   			break;
   		case flux : 
   			document.getElementById("flux").src = "./img/flux2.png";
   			break;
   		case logout : 
   			document.getElementById("logout").src = "./img/logout2.png";
   			break;
   		default:
   	}
   }
   
   
   function closewindow(windowid){
   	switch (windowid){
   		case closeadd :
   			if (document.getElementById("addform").style.display ==""){
   				document.getElementById("addform").style.display = "none";
   			}
   			else {
   				document.getElementById("addform").style.display = "";
   			}
   			break;
   		case closesuppr : 
   			if (document.getElementById("supprform").style.display ==""){
   				document.getElementById("supprform").style.display = "none";
   			}
   			else {
   				document.getElementById("supprform").style.display = "";
   			}
   			break;
      	default:
   	}

   }
   
   function actionflux(actionid, fluxid, user=""){
   	switch (actionid){
   		case action1 :
   			editflux("update", fluxid,  user);
   			alert('RSS flux updated');
   			break;
   		case action2 : 	
   				if (document.getElementById("item_"+ fluxid).className == "tableitem activated")	{
   					var desactive=confirm ('Are you sure you want to desactivate this flux ?');
   				}
   				if (document.getElementById("item_"+ fluxid).className == "tableitem desactivated") {
   					var active=confirm ('Are you sure you want to activate this flux ?');
   				}
   				if (desactive==true){
   					document.getElementById("item_"+ fluxid).className = "tableitem desactivated";
   					editflux("desactive", fluxid, user);
   					document.getElementsByName("action2_"+ fluxid)[0].src = "./img/activated.png";
   					document.getElementsByName("action2_"+ fluxid)[0].title = "Activate flux";
   					//alert('Flux rss désactivé');//	
   				}
   				if (active==true) {
   					document.getElementById("item_"+ fluxid).className = "tableitem activated";
   					editflux("active", fluxid, user);
   					document.getElementsByName("action2_"+ fluxid)[0].src = "./img/desactivated.png";
   					document.getElementsByName("action2_"+ fluxid)[0].title = "Desactivate flux";
   					//alert('Flux rss activé');//
   				}
   			break;
   		case action3 : 
   			if (document.getElementById("changename"+ fluxid).style.display =="none"){
   				document.getElementById("fluxname"+ fluxid).style.display = "none";
   				document.getElementById("changename"+ fluxid).style.display = "";
   				document.getElementById("changename"+ fluxid).value = "";
   				document.getElementById("confirmname"+ fluxid).style.display = "";
   				document.getElementsByName("action3_"+ fluxid)[0].src = "./img/edit2.png";
   				document.getElementsByName("action3_"+ fluxid)[0].title = "Cancel 'Edit flux' action";
   			}
   			else{
   				document.getElementById("fluxname"+ fluxid).style.display = "";
   				document.getElementById("changename"+ fluxid).style.display = "none";
   				document.getElementById("confirmname"+ fluxid).style.display = "none";
   				document.getElementsByName("action3_"+ fluxid)[0].src = "./img/edit.png";
   				document.getElementsByName("action3_"+ fluxid)[0].title = "Edit flux";   			
   			}
   			break;
   		case action4 :
   			var erase=confirm ('Are you sure you want to erase this flux ?');
			if (erase==true){
   					editflux("erase", fluxid, user);
   					document.getElementById("item_"+ fluxid).style.display = "none";
   					//alert('Flux rss supprimé');//	
   				}
   			break;
      	default:
   	}
   }
   	
   	function changefluxname(fluxid, user){
		var newname = document.getElementById("changename"+ fluxid).value;
		if (document.getElementById("changename"+ fluxid).value!=""){
			editflux("edit", fluxid, user, newname);
			document.getElementById("fluxname"+ fluxid).innerHTML = newname;
			document.getElementById("fluxname"+ fluxid).style.display = "";
   			document.getElementById("changename"+ fluxid).style.display = "none";
   			document.getElementById("confirmname"+ fluxid).style.display = "none";
   			document.getElementsByName("action3_"+ fluxid)[0].src = "./img/edit.png";   
		}
		else {
			alert ("Please use a valid name for the RSS flux");	
		}
	}
	
	function addflux() {
		if (document.getElementById("addflux").style.display == "none"){
			document.getElementById("addflux").style.display = "";
			document.getElementById("fluxbutton").src = "./img/add2.png";
			document.getElementById("fluxbutton").title = "Cancel 'Add flux' action";
		}
		else{
			document.getElementById("addflux").style.display = "none";
			document.getElementById("fluxbutton").src = "./img/add.png";
			document.getElementById("fluxbutton").title = "Add flux";
		}
	}
	
	function updateallflux(user) {
		var update =confirm ('Updating all RSS flux can take some time. Are you sure you want to do this ?');
		if (update==true){
   		var userid = user;
		$.ajax({
   			type: "POST",
   			url: "./js/ajax/editflux.php",
   			data: {usernum : userid},
   			success: function(data){
   				alert('All RSS flux have been updated.');
   			}
 			});
		}
	}