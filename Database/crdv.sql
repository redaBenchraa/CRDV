/*==============================================================*/
/* nom de sgbd :  mysql 4.0                                     */
/* date de cr�ation :  08/01/2018 23:32:45                      */
/*==============================================================*/
drop database crdv;
create database if not exists crdv;
use crdv;

drop table if exists acte;

drop table if exists activite;

drop table if exists adaptation;

drop table if exists categorieProfessionnelle;

drop table if exists categorie;

drop table if exists centre;

drop table if exists emploiDuTemps;

drop table if exists parametre;

drop table if exists professionnelle;

drop table if exists usager;

drop table if exists sousCategorie;

/*==============================================================*/
/* table : acte                                                 */
/*==============================================================*/
create table acte
(
   id                             int                            not null AUTO_INCREMENT,
   usager_id                         int                            not null,
   activite_id                         int,
   duree                          int,
   modeSaisie                     varchar(254),
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : activite                                             */
/*==============================================================*/
create table activite
(
   id                             int                            not null AUTO_INCREMENT,
   professionnelle_id                         int                            not null,
   usager_id                         int                            not null,
   categorie_id                         int                            not null,
   sousCategorie_id                         int                            not null,
   duree                          int,
   cloture                        bool,
   planifie                       bool,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id),
   key ak_identifier_1 (id)
)
engine = innodb;

/*==============================================================*/
/* table : adaptation                                           */
/*==============================================================*/
create table adaptation
(
   acte_id                         int                            not null,
   id                             int                            not null AUTO_INCREMENT,
   nom                            int,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : categorieProfessionnelle;				*/
/*==============================================================*/
create table categorieProfessionnelle
(
   professionnelle_id                             int                            not null,
   categorie_id                         int                            not null,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (professionnelle_id, categorie_id)
)
engine = innodb;

/*==============================================================*/
/* table : categorie                                            */
/*==============================================================*/
create table categorie
(
   id                             int                            not null AUTO_INCREMENT,
   centre_id                         int                            not null,
   intitule                       varchar(25),
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : centre                                               */
/*==============================================================*/
create table centre
(
   id                             int                            not null AUTO_INCREMENT,
   parametre_id                         int                      ,
   nom                            varchar(254),
   adresse                        varchar(254),
   telephone                      varchar(254),
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id),
   key ak_identifier_1 (id)
)
engine = innodb;

/*==============================================================*/
/* table : emploiDuTemps                                      */
/*==============================================================*/
create table emploiDuTemps
(
   id                             int                            not null AUTO_INCREMENT,
   professionnelle_id                         int                            not null,
   acte_id                         int                            not null,
   jour                           int,
   heureDebut                     time,
   heureFin                       time,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id),
   key ak_identifier_1 (id)
)
engine = innodb;

/*==============================================================*/
/* table : parametre                                            */
/*==============================================================*/
create table parametre
(
   id                             int                            not null AUTO_INCREMENT,
   nom                            int,
   valeur                         int,
   type                           int,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : professionnelle                                      */
/*==============================================================*/
create table professionnelle
(
   id                             int                            not null AUTO_INCREMENT,
   centre_id                         int                            not null,
   nom                            varchar(254),
   prenom                         varchar(254),
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : usager                                               */
/*==============================================================*/
create table usager
(
   id                             int                            not null AUTO_INCREMENT,
   centre_id                         int                            not null,
   nom                            varchar(254),
   prenom                         varchar(254),
   age                            int,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id),
   key ak_identifier_1 (id)
)
engine = innodb;

/*==============================================================*/
/* table : sousCategorie                                        */
/*==============================================================*/
create table sousCategorie
(
   categorie_id                         int                            not null,
   id                             int                            not null AUTO_INCREMENT,
   intitule                       varchar(254),
   type                           bool,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

alter table acte add constraint fk_association_5 foreign key (acte_id)
      references activite (id) on delete restrict on update restrict;

alter table acte add constraint fk_association_6 foreign key (usager_id)
      references usager (id) on delete restrict on update restrict;

alter table activite add constraint fk_association_13 foreign key (sousCategorie_id)
      references sousCategorie (id) on delete restrict on update restrict;

alter table activite add constraint fk_association_14 foreign key (usager_id)
      references usager (id) on delete restrict on update restrict;

alter table activite add constraint fk_association_8 foreign key (professionnelle_id)
      references professionnelle (id) on delete restrict on update restrict;

alter table adaptation add constraint fk_generalization_1 foreign key (acte_id)
      references acte (id) on delete restrict on update restrict;

alter table categorieProfessionnelle add constraint fk_association_3 foreign key (categorie_id)
      references categorie (id) on delete restrict on update restrict;

alter table categorieProfessionnelle add constraint fk_association_4 foreign key (professionnelle_id)
      references professionnelle (id) on delete restrict on update restrict;

alter table categorie add constraint fk_association_15 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table centre add constraint fk_association_10 foreign key (parametre_id)
      references parametre (id) on delete restrict on update restrict;

alter table emploiDuTemps add constraint fk_association_16 foreign key (acte_id)
      references activite (id) on delete restrict on update restrict;

alter table emploiDuTemps add constraint fk_association_2 foreign key (professionnelle_id)
      references professionnelle (id) on delete restrict on update restrict;

alter table professionnelle add constraint fk_association_1 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table usager add constraint fk_association_12 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table sousCategorie add constraint fk_association_11 foreign key (categorie_id)
      references categorie (id) on delete restrict on update restrict;
