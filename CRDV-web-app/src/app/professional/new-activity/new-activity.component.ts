import { Component, OnInit } from '@angular/core';
import {forEach} from "@angular/router/src/utils/collection";
import {duration} from "moment";

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
  durationDirecte = [
    {value : '45', lable : '45min'},
    {value : '90', lable : '1h 30min'},
    {value : '135', lable : '2h 15min'},
    {value : '180', lable : '3h'},
  ];

  durationIndirecte = [
    {value : '5', lable : '5min'},
    {value : '10', lable : '10min'},
    {value : '15', lable : '15min'},
    {value : '20', lable : '20min'},
    {value : '25', lable : '25min'},
    {value : '30', lable : '30min'},
    {value : '35', lable : '35min'},
    {value : '40', lable : '40min'},
    {value : '45', lable : '45min'},
    {value : '50', lable : '50min'},
    {value : '55', lable : '55min'},
    {value : '60', lable : '1h'},
  ];
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


  constructor() {
  }

  ngOnInit() {
    $('select').on('click' , function() {

      $(this).parent('.select-box').toggleClass('open');

    });

    $(document).mouseup(function (e) {
      const container = $('.select-box');
      if (container.has(e.target).length === 0) {
        container.removeClass('open');
      }
    });


    $('select').on('change' , function() {

      const selection = $(this).find('option:selected').text(), labelFor = $(this).attr('id'),
        label = $("[for='" + labelFor + "']");

      label.find('.label-desc').html(selection);

    });
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

  getDuration(category) {
    let durations = [];

    if ( category === 1) {
      durations = this.durationIndirecte;
    } else {
      durations = this.durationDirecte;
    }
    for (const data of this.durationIndirecte) {
      if ( data.value === this.model['duration']) {
        return data.lable;
      }
    }
  }

}
