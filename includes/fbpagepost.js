//Facebook Page Post script
 var dotCounter = 0;
      function setliposition() {
         setTimeout(function() {
               if (dotCounter++ < 10) {
	    	    var maxheight = 0;
                var flg=0;
		  	    var left=0;
			    var toppos=0;
		        jQuery('#gridfbfeed li').each(function(){
			        /*Get parrent li height*/
					var currnetid = parseInt(jQuery(this).attr('id'));
					var parrentId =currnetid-40;
				    if(parrentId>0)
					 {
						  if(parrentId==0)
						  {
						   parrentId='00';
						  }
						  
						   var link= jQuery('#'+parrentId);
						   var offset = jQuery('#'+parrentId).offset();
						   var top = offset.top+parseInt(jQuery('#'+parrentId).height());
						   toppos = link.outerHeight()+15;
						  if(parrentId>40)
						  {
								 
							 toppos+=parseInt(jQuery('#'+parrentId).css('top'));
						   }
				
				   }
				
				
				 /*Get parrent li height*/
			
					if(flg >0 && flg <4 )
					{
					  left=left+230;
					}
					if(flg >=4)
					{
					  flg=0;
					  left=0;
					}
					flg++;
					jQuery(this).css({"position": "absolute", "top": toppos+"px","left" : left+"px"});
		   });

	
  
    }
  }, 1000);
}

function setview(view)
{
  if(view==1)
  {
    jQuery('#fbfeed').attr('id','gridfbfeed');
	 setliposition();
  }
}


	
        
	
	
