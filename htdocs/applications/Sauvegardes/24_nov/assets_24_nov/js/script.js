window.onload = function(){


	// Tout d'abord créons un tableau de mots clefs :
	var motsClefs = [
		'Kommunauty',
		'Kommunauté',
		'K',
		'Krousty',
		'Bob',
		'Boby',
		'Bobu'
	        // ...
	];

	// On récupère le formulaire à l'aide de son ID
	var form = document.getElementById("auto-suggest");
	// On récupère le champ de texte
	var input = form.search;

	// On créer un "UL"
	var list = document.createElement("ul");
	// On lui ajoute la classe "suggestions"
	list.className = "suggestions";
	// On le cache pour qu'il ne soit pas visible
	list.style.display = "none";

	// On l'ajoute à l'intérieur du formulaire
	form.appendChild(list);

	input.onkeyup = function(){
	    // On récupère le texte	
	    var txt = this.value;

	    // Si le texte est vide, alors on arrète la la fonction, et on cache la liste
	    if(!txt){
	        list.style.display = "none";
		return;
	    }
	    
	    // variable qui indiquera le nombre de suggestions correspondantes	
	    var suggestions = 0;
	    // On créer une variable qui contiendra toute les suggestions qui seront affichées
	    var frag = document.createDocumentFragment();
			
	    for(var i = 0, c = motsClefs.length; i < c; i++){

	    	// Si l'expression régulière correspond au mot clef
			if(new RegExp("^"+txt,"i").test(motsClefs[i])){
			    // On créé l'élément HTML "LI"
			    var word = document.createElement("li");
			    // On l'ajoute au fragment
			    frag.appendChild(word);
			    // On lui mets comme contenu le mot clef avec en gras les lettres entrées
			    // (grâce à une RegEx et à la fonction replace() ^^ )
			    word.innerHTML = motsClefs[i].replace(new RegExp("^("+txt+")","i"),"<strong>$1</strong>");
			    // On ajoute le mot clef à l'élément HTML "LI", pour pouvoir le récupérer plus tard
			    word.mot = motsClefs[i];

			    // Lorsque le visiteur clique sur le lien
			    word.onmousedown = function(){
			        // On re-sélectionne le champ de texte		
				input.focus();
			        // On remplace sa valeur par le mot clef
				input.value = this.mot;
			        // On cache la liste
				list.style.display = "none";

			        // On empêche la dé-sélection du champ
			        return false;
			    };
			    // On indique qu'une suggestion a été ajoutée		
			    suggestions++;
			}
	    }

	    // Si il y a des suggestions qui peuvent être affichées
	    if(suggestions){
	        // On vide le contenu de la liste
	        list.innerHTML = "";
	        // On lui ajoute les différentes suggestions
		list.appendChild(frag);
	        // On affiche la liste
		list.style.display = "block";
	    } // Sinon s'il n'y en a pas
	    else {
	        // On cache la liste
		list.style.display = "none";			
	    }	
	};

	// Quand l'utilisateur dé-sélectionne le champ
	// (Quand il clique ailleurs sur la page)
	input.onblur = function(){
	    // On cache la liste
	    list.style.display = "none";	
	    // Si le contenu est vide on le remplace par le mot par défaut
	    if(this.value=="")
	        this.value = "Rechercher...";
	};
};