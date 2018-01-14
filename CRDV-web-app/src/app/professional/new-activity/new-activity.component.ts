import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-new-activity',
  templateUrl: './new-activity.component.html',
  styleUrls: ['./new-activity.component.scss']
})
export class NewActivityComponent implements OnInit {
  selectedCategorie= [];
  selectedActivite= [];
  selectedGroupe= [];
  selectedUsager= [];
  selectedProffessionelle= [];
  model= [];
  duree = 45;
  rowsCategorie = [
    { Id : '1', Categorie: 'Austin' },
    { Id : '1', Categorie: 'Dany'},
    { Id : '1', Categorie: 'Molly' },
  ];
  rowsActivite = [
    { Id : '1', nom: 'Austin' },
    { Id : '1', nom: 'Dany'},
    { Id : '1', nom: 'Molly' },
  ];
  rowsUsager = [
    { Id : '1', nom: 'Austin', prenom: 'Fa'},
    { Id : '1', nom: 'Dany', prenom: 'Fa'},
    { Id : '1', nom: 'Dany', prenom: 'Fa' },
  ];
  rowsGroupe = [
    { Id : '1', nom: 'Austin', prenom: 'Fa' },
    { Id : '1', nom: 'Dany', prenom: 'Fa'},
    { Id : '1', nom: 'Dany', prenom: 'Fa' },
  ];
  rowsProffessionelle = [
    { Id : '1', nom: 'Austin' },
    { Id : '1', nom: 'Dany', prenom: 'Fa'},
    { Id : '1', nom: 'Dany', prenom: 'Fa' },
  ];


  constructor() { }

  ngOnInit() {
  }
  onSelect(index, { selected }) {
    console.log(this.model);
    switch (index) {
      case 1 :
        console.log(this.selectedCategorie);
        break;
      case 2 :
        console.log(this.selectedActivite);
        break;
      case 3 :
        console.log(this.selectedUsager);
        break;
      case 4 :
        console.log(this.selectedGroupe);
        break;
      case 5 :
        console.log(this.selectedProffessionelle);
        break;
    }
  }

  getCategorieType(index) {
    if ( index === 1) {
      return 'Directe';
    } else {
      return 'Indirecte';
    }
  }
  getUsagerType(index) {
    if ( index === 1) {
      return 'Individuel';
    } else {
      return 'Groupe';
    }
  }
  getSelectedCategorie() {
    if ( this.selectedCategorie.length === 0 ) {
      return ' ';
    }else {
      return this.selectedCategorie[0].Categorie;
    }
  }

  getSelectedActivite() {
    if ( this.selectedActivite.length === 0 ) {
      return ' ';
    }else {
      return this.selectedActivite[0].nom;
    }
  }

}
