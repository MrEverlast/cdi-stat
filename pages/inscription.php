 <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  
 
<div class="ui secondary  menu">
  <div class="right menu">
    <a class="ui item">
      Logout
    </a>
  </div>
</div>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      
      <div class="content">
        CDI
      </div>
    </h2>
    <form class="ui large form aligned left">
	
      <div class="ui stacked segment">
		
			<div class="field">
				<a class="ui blue ribbon label" style="text_align_center=left" >Elève</a>
				<select class="ui search dropdown">
					<option value="">Selectionnez l'élève..</option>
					// BASE //
					<option value="AF">Afghanistan</option>
					<option value="AX">Åland Islands</option>
					////////
					
				</select>
			</div>
		
		
        
			<div class="field ">
				<a class="ui blue ribbon label" style="text_align_center=left" >Acitivité</a>
				<select class="ui search dropdown">
					<option value="">Selectionnez l'activité..</option>
					// BASE //
					<option value="AF">Afghanistan</option>
					<option value="AX">Åland Islands</option>
					////////
				</select>
			</div>
		
		
			<div class="field">
				<a class="ui blue ribbon label" style="text_align_center=left" >Durée</a>
				<select class="ui search dropdown">
					<option value="">Selectionnez la durée..</option>
					// BASE //
					<option value="AF">1h</option>
					<option value="AX">2h</option>
					<option value="AX">3h</option>
					<option value="AX">4h</option>
					/////////
				</select>
			</div>
		
        <div class="ui fluid large teal submit button">S'enregistrer</div>
		
      </div>

      <div class="ui error message"></div>

    </form>

   
  </div>
</div>