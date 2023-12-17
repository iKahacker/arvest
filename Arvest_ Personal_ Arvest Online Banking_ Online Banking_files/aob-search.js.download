$(document).ready(function()
{
	
	
	//Maintenace is true if during Maintenance time 
	var $aobMaint = false;
	
	
	//if (window.location.hostname!=='www.arvest.com')//will skip code in prod but run in other stages
	//{
		
		var host = '/personal/signon/logon/';
		
		$('body').on('submit', '.login-form-aob', function(event){//main page on arvest.com dropdown list 
			
			if($aobMaint)//online banking under maintenance time
			{
				
				url_redirect({url:"/personal/signon/logon/",
									  method: "post",
									  data: {"usererr": username}
									  });
				event.preventDefault();
				
			}
			else
			{	
				$( '.modal-close' ).replaceWith( '<div class="modal-close"></div>' );
					
				var $str
				var $input_name = $(this).find('input[name=j_username]'),
				username = $input_name.val();
				
				var $par_name = getQueryVariable('q');
				console.log('username', username);
				
			
				if (username.length == 0)
				{
						
						url_redirect({url:"/personal/signon/logon/",
									  method: "post",
									  data: {"usererr": username}
									  });
						event.preventDefault();
						//}
				}
				else
				{
		
					var request = $.ajax({
							async: false,
							url: "/personal/signon/logon",
							type: "POST",			
							data: {"username": username, "q": $par_name  },
							success: function(data){
						
						if (data.length > 2)
						{
							var parts = data.split(" "),
							first = parts.shift(),
							last = parts.shift() ;
							data = first.replace('"','');  //remove  char
							last  = last.replace('"','');   //remove  char
							last = last.replace('_',' '); //remove first char
							$mdate  = $.trim(last.replace ('_',' ')); //remove second char
							
						}
						//set variables when password reset flow is in progress
							var passwordResetRequestS1 = (typeof $par_name != "undefined" && (data == 1));
							var passwordResetRequestD3 = (typeof $par_name != "undefined" && data == 2);
							var passwordResetInvalidID = (typeof $par_name != "undefined" && (data == 0));
							
							//set over ride data variable if password reset flow is in progress				
							switch(true){
								case  passwordResetInvalidID :
										 
								break;
								case  passwordResetRequestD3 :
																data="3"; 
								break;
								
								case passwordResetRequestS1 :
								
																data="5";
								break;
																
							}
								
							switch(data){							
								
									case "2":
											url_redirect({url:"/personal/signon/logon/authenticate",
												method: "post",
												data: {"username": username}
											});
											event.preventDefault();
									break;
									case "0":
												url_redirect({url:"/personal/signon/logon/",
												method: "post",
												data: {"usererr": username}
											});
											event.preventDefault();
									break;
									
									default:
										url_redirect({url: host,
                 							method: "post",
                  								data: {"usererr": username}
               				  				});
							    		event.preventDefault();
							}
								
							},
							error: function(){//will allow form on functions_content.php to post j_username to S1
							}
					});
				}
			}
		});	
		
   		$('body').on('submit', '#aoblogon', function(event){ ///personal/signon/logon/ page
		
			var $mdate = null;
	 		var $input_name = $(this).find('input[name=userid]'),
          					  username = $input_name.val();
			
			var $par_name = getQueryVariable('q');
			console.log('username', username);
			
			if (username.length == 0)
				{
					var passwordResetEmptyID = (typeof $par_name != "undefined");
					if (!passwordResetEmptyID)
					{
						url_redirect({url:"/personal/signon/logon/",
									  method: "post",
									  data: {"usererr": username}
									  });
						event.preventDefault();
					}
					else
					{
						url_redirect({url:"/personal/signon/logon/&q=passwordreset",
									  method: "post",
									  data: {"empty": username}
									  });
						event.preventDefault();
						
					}
						//}
				}
				else
				{			
			//ajax call to index.inc in arvest.com\content\myArvest\aob_login\logon\ 
			var request = $.ajax(
			{
				
						async: false,
						url: "/personal/signon/logon/",
						type: "POST",			
						data: {"username": username, "q": $par_name },
						success: function(data){ // return was successful
						
						if (data.length > 2)
						{
							var parts = data.split(" "),
							first = parts.shift(),
							last = parts.shift() ;
							data = first.replace('"','');  //remove  char
							last  = last.replace('"','');   //remove  char
							last = last.replace('_',' '); //remove first char
							$mdate  = $.trim(last.replace ('_',' ')); //remove second char
							
						}
					       
							//set variables when password reset flow is in progress
							var passwordResetRequestS1 = (typeof $par_name != "undefined" && (data == 1));
							var passwordResetRequestD3 = (typeof $par_name != "undefined" && data == 2);
							var passwordResetInvalidID = (typeof $par_name != "undefined" && (data == 0));
							
							//set over ride data variable if password reset flow is in progress				
							switch(true){
								case  passwordResetInvalidID :
										 					//data="0"; 
								break;
								case  passwordResetRequestD3 :
																data="3"; 
								break;
								
								case passwordResetRequestS1 :
								
																data="5";
								break;
																
							}
							
							//switch statement to redirect to d3, blueIQ, or S1
							switch(data){
								case "2":
										//d3 user check for lockout/challenge/enroll
										url_redirect({url:"/personal/signon/logon/authenticate",
                 							method: "post",
                  							data: {"username": username}
               				  			});
			 							//return false;//kills the post on form
										event.preventDefault();
										
								break;
								case "3"://password reset process has been triggered
								 			url_redirect({url:"/personal/signon/logon/authenticate/&q=passwordreset",
                 							method: "post",
                  							data: {"username": username,"ssoaction": $par_name}
               				  			});
			 							//return false;//kills the post on form
										event.preventDefault();
								break;
								case "5"://is s1 user and send s1 error
									
										url_redirect({url:"/personal/signon/logon/",
                 							method: "post",
                  							data: {"usererr": "s1"}
										});
										event.preventDefault();
								break;
																
								case "0"://invalid user name
									 //event.preventDefault();
									
									 if(passwordResetInvalidID)
									 {
										 url_redirect({url:"/personal/signon/logon/&q=passwordreset",
                 							method: "post",
                  							data: {"usererr": username}
											
               				  			});
									 }
									 else
									 {
										url_redirect({url:"/personal/signon/logon",
                 							method: "post",
                  							data: {"usererr": username}
											
               				  			});
									 }
								event.preventDefault();
								break;
								default:
										url_redirect({url: host,
                 							method: "post",
                  								data: {"usererr": username}
               				  				});
							    event.preventDefault();
															
								}
							},
						error: function(){
							//will allow normal onsubmit post 
									
							url_redirect({url: host,
								method: "post",
								data: {"usererr": username}
							});
							event.preventDefault();
								
						}
			
						});
				}

			});
  
			
			 function url_redirect(options){
                 var $form = $("<form />");
                 
                 $form.attr("action",options.url);
                 $form.attr("method",options.method);
				                  
                 for (var data in options.data)
                 $form.append('<input type="hidden" name="'+data+'" value="'+options.data[data]+'" />');
                  
                 $("body").append($form);
                 $form.submit();
		 	}
				
							
			function getQueryVariable(variable)
			{
   				 var query = window.location.href;
   				 var vars = query.split('&');
   				 for (var i = 1; i < vars.length; i++)
				 {
					
        			var pair = vars[i].split('=');
        			if (decodeURIComponent(pair[0]) == variable)
					{
           				 return decodeURIComponent(pair[1]);
        			}
   				 }
    				console.log('Query variable %s not found', variable);
			}
			
			
//}
			
			
});
		