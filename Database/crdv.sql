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

drop table if exists groupe;

drop table if exists sousCategorie;

drop table if exists serafin;

/*==============================================================*/
/* table : acte                                                 */
/*==============================================================*/
create table acte
(
   id                             int                            not null AUTO_INCREMENT,
   usager_id                         int                            not null,
   duree                          int,
   modeSaisie                     varchar(254),
   complet                        bool,
   cumuleDuree                          int,
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
   groupe_id                         int                            not null,
   categorie_id                         int                            not null,
   sous_categorie_id                         int                            not null,
   acte_id			int,
   duree                          int,
   cloture                        bool,
   planifie                       bool,
   date                           date,
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
/* table : emploiUsager;				*/
/*==============================================================*/
create table emploiUsager
(
   emploi_du_temps_id                  int                            not null,
   usager_id                         int                            not null,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (emploi_du_temps_id, usager_id)
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
   professionnelle_id             int                            not null,
   sous_categorie_id              int                            not null,
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
   nom                            varchar(25),
   valeur                         varchar(25),
   type                           int,
   centre_id                       int,
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
   username                         varchar(254),
   password                         varchar(254),
   type                           tinyint(2),
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
   groupe_id                         int                            not null,
   nom                            varchar(254),
   prenom                         varchar(254),
   date_de_naissance              Date,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id),
   key ak_identifier_1 (id)
)
engine = innodb;

/*==============================================================*/
/* table : groupe                                               */
/*==============================================================*/
create table groupe
(
   id                             int                            not null AUTO_INCREMENT,
   nom                            varchar(254),
   centre_id                         int                            not null,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : sousCategorie                                        */
/*==============================================================*/
create table sousCategorie
(
   categorie_id                         int                            not null,
   serafin_id                         int                            not null,
   id                             int                            not null AUTO_INCREMENT,
   intitule                       varchar(254),
   type                           bool,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;

/*==============================================================*/
/* table : serafin                                        */
/*==============================================================*/
create table serafin
(
   id                             int                            not null AUTO_INCREMENT,
   code                       varchar(254),
   intitule                       varchar(254),
   serafin_id                         int,
   created_at timestamp default current_timestamp, updated_at timestamp null on update current_timestamp, deleted_at timestamp null,primary key (id)
)
engine = innodb;


alter table acte add constraint fk_association_6 foreign key (usager_id)
      references usager (id) on delete restrict on update restrict;

alter table activite add constraint fk_association_13 foreign key (sous_categorie_id)
      references sousCategorie (id) on delete restrict on update restrict;

alter table activite add constraint fk_association_133 foreign key (groupe_id)
      references groupe (id) on delete restrict on update restrict;

alter table activite add constraint fk_association_17 foreign key (acte_id)
      references acte (id) on delete restrict on update restrict;

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
      

alter table emploiUsager add constraint fk_association_43 foreign key (usager_id)
references usager (id) on delete restrict on update restrict;

alter table emploiUsager add constraint fk_association_44 foreign key (emploi_du_temps_id)
references emploiDuTemps (id) on delete restrict on update restrict;

alter table categorieProfessionnelle add constraint fk_association_4 foreign key (professionnelle_id)
references professionnelle (id) on delete restrict on update restrict;

alter table categorie add constraint fk_association_15 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table emploiDuTemps add constraint fk_association_16 foreign key (sous_categorie_id)
      references sousCategorie (id) on delete restrict on update restrict;

alter table emploiDuTemps add constraint fk_association_2 foreign key (professionnelle_id)
      references professionnelle (id) on delete restrict on update restrict;

alter table professionnelle add constraint fk_association_1 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table parametre add constraint fk_association_22 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table usager add constraint fk_association_12 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;
      
alter table groupe add constraint fk_association_122 foreign key (centre_id)
      references centre (id) on delete restrict on update restrict;

alter table usager add constraint fk_association_19 foreign key (groupe_id)
      references groupe (id) on delete restrict on update restrict;

alter table sousCategorie add constraint fk_association_11 foreign key (categorie_id)
      references categorie (id) on delete restrict on update restrict;

alter table sousCategorie add constraint fk_association_20 foreign key (serafin_id)
      references serafin (id) on delete restrict on update restrict;

alter table serafin add constraint fk_association_21 foreign key (serafin_id)
      references serafin (id) on delete restrict on update restrict;

