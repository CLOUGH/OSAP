<!--
		function include(filename)
		{
			var head = document.getElementByTagName('head')[0];

			var script = document.createElement('script');
			script.src = filename;
			script.type = 'text/javascript';
			head.appendChild(script);
		}


		window.onload = function()
		{
			var main_menu_list = document.getElementsByTagName('nav')[0].children[0].children;
			var sub_menu_list;
			console.log(main_menu_list.length);
			
			for(var i=0 ; i<main_menu_list.length;i++)
			{
				
				console.log(i+"."+main_menu_list[i].tagName);
				if(main_menu_list[i].children.length>1)
					sub_menu_list = main_menu_list[i].children[1].children; 
				else
					sub_menu_list = main_menu_list[i].children[0].children;
				
				for(var j=0;j<sub_menu_list.length;j++)
				{
					/*Add  listeners elements in the list*/
					console.log("\t"+j+"."+sub_menu_list[j].tagName);
					sub_menu_list[j].onmouseover=function(){
						console.log(this.parentNode.parentNode.tagName);
						if(this.parentElement.parentElement)
						this.parentElement.parentElement.parentElement.setAttribute("class", "test");
						
					};
					sub_menu_list[j].onmouseout= function()
					{
						this.parentNode.parentNode.setAttribute("class", null);
					}
				}


			}
			
			
		};

	//-->