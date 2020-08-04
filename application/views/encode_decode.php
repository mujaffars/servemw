<div style="width: 100%">
			<center>Encode/ Decode String <select id="iv" style="width: 60px;"><option value="0">NO</option><option value="1">Yes</option></select></center><br><br>	
		</div>
		
		<div style="width: 100%; clear:float">
			<div style="width: 50%; float: left">
				<label>Encoded String:-</label>
				<textarea id="decodeString" style="margin: 0px; height: 150px; width: 98%;" onchange ="getdecodeData('1')"></textarea>		
			</div>
			<div style="width: 50%; float: left">
				<label>Normal String:-</label>
				<textarea id="encodeString" style="margin: 0px; height: 150px; width: 98%;" onchange="getdecodeData('2')"></textarea>	
			</div>
		</div>
			 
		 
<script type="text/javascript">
	function getdecodeData(flag){
		var iv = document.getElementById("iv").value;
		if(flag =='1'){
			var string = document.getElementById("decodeString").value;	
		}else{
			var string = document.getElementById("encodeString").value;	
		}
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	if(flag=='1'){
		    		document.getElementById("encodeString").value = this.responseText;
		    	}else{
		    		document.getElementById("decodeString").value = this.responseText;
		    	}
		      
		    }
		  };
		  xhttp.open("POST", "<?php echo base_url()?>/welcome/getdata", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		 xhttp.send("string="+btoa(string)+"&flag="+flag+"&iv="+iv);
		
	}
</script>		