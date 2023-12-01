


function getObjetXMLHttpRequest()
				{
				var requeteHttp;
				if (window.XMLHttpRequest) //Mozilla
					{
					requeteHttp=new XMLHttpRequest();
					if (requeteHttp.overrideMimeType) //Firefox
						{
						requeteHttp.overrideMimeType('text/xml');
						}
					}
				else
					{
					if (window.ActiveXObject) //IE < 7
						{
						try
							{
							requeteHttp=new ActiveXObject("Msxml2.XMLHTTP");
							}
						catch(e)
							{
							try
								{
								requeteHttp=new ActiveXObject("Microsoft.XMLHTTP");
								}
							catch(e)
								{
								requeteHttp=null;
								alert ("Navigateur incompatible");
								}
							}
						}
					}
				return requeteHttp;
				}
		
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		//Fonction permettant de faire un appel Ajax
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
			function appelAjax()
				{
				    var requeteHttp=getObjetXMLHttpRequest();
				    if (requeteHttp!=null)
					{
                        var laListe;
                        laListe = document.getElementById('theme');
                        var uneRef;
                        uneRef = laListe.options[laListe.selectedIndex].value;
                        requeteHttp.open("POST","Vues/ihm/ajax.php",true);
                        requeteHttp.setRequestHeader("Content-Type",
                            "application/x-www-form-urlencoded");
                        requeteHttp.send('ref='+uneRef);
                        requeteHttp.onreadystatechange = 
                            function () {recevoirReponseRequeteAjax(requeteHttp)};
					
					}

				}	
				
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		//Fonction permettant de recevoir et de traiter la reponse de la requete Ajax
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------				
			function recevoirReponseRequeteAjax(requeteHttp)
				{
				    if (requeteHttp.readyState==4)
					{
					    if (requeteHttp.status==200)
						{

                            var lesMat = requeteHttp.responseText;
                            document.getElementById('zoneResultat').innerHTML = lesMat;
						}
                        else{
                        
                            alert(requeteHttp.readyState);
                        }
                    }

				}

			window.onload = function ()
			{

				if(document.getElementById('selectBox') !== null){

					document.getElementById('selectBox').disabled = true;
				}

			}

			function refreshPage() {
				location.reload();
			  }