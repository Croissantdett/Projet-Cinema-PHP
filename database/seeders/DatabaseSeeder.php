<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use App\Models\Film;
use App\Models\Cinema;
use App\Models\TypeSalle;
use App\Models\Salle;
use App\Models\TypeSeance;
use App\Models\Langue;
use App\Models\Seance;
use App\Models\Tarif;
use App\Models\RoleUtilisateur;
use App\Models\Personne;
use App\Models\RolePersonne;
use App\Models\Participe;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. GENRES
        $g1 = Genre::create(['libGenre' => 'Action']);
        $g2 = Genre::create(['libGenre' => 'Science-Fiction']);
        $g3 = Genre::create(['libGenre' => 'Comedie']);
        $g4 = Genre::create(['libGenre' => 'Drame']);
        $g5 = Genre::create(['libGenre' => 'Animation']);
        $g6 = Genre::create(['libGenre' => 'Fantastique']);
        $g7 = Genre::create(['libGenre' => 'Thriller']);

        // 2. FILMS
        $f1  = Film::create(['titreFil' => 'John Wick',                           'descFil' => 'Un ancien tueur a gages, force de sortir de sa retraite apres la mort de son chien, se lance dans une vengeance impitoyable contre la mafia russe.',                                                          'imgFil' => 'johnwick.jpg',       'dureFil' => 101, 'dateSortie' => '2014-10-24', 'idGenre' => $g1->idGenre]);
        $f2  = Film::create(['titreFil' => 'Avatar',                               'descFil' => 'Sur la lune Pandora, un marine paraplégique s infiltre parmi les Na vi pour une mission d espionnage, mais se retrouve dechire entre ses ordres et sa nouvelle vie au sein du peuple indigene.',              'imgFil' => 'avatar.jpg',         'dureFil' => 162, 'dateSortie' => '2009-12-16', 'idGenre' => $g2->idGenre]);
        $f3  = Film::create(['titreFil' => 'La Grande Vadrouille',                 'descFil' => 'Deux Francais aux caracteres opposes se retrouvent meles a une folle aventure pour aider trois aviateurs anglais a traverser la France occupee par les Allemands.',                                           'imgFil' => 'vadrouille.jpg',     'dureFil' => 132, 'dateSortie' => '1966-12-08', 'idGenre' => $g3->idGenre]);
        $f4  = Film::create(['titreFil' => 'Titanic',                              'descFil' => 'A bord du paquebot le plus celebre de l histoire, une jeune aristocrate tombe amoureuse d un artiste sans le sou, mais leur romance est menacee par le naufrage tragique du navire.',                         'imgFil' => 'titanic.jpg',        'dureFil' => 195, 'dateSortie' => '1997-12-19', 'idGenre' => $g4->idGenre]);
        $f5  = Film::create(['titreFil' => 'Le Roi Lion',                          'descFil' => 'Simba, jeune lionceau heritier du royaume de la Terre des Lions, est contraint de fuir apres la mort de son pere et doit affronter son passe pour reprendre sa place de roi.',                                'imgFil' => 'roilion.jpg',        'dureFil' => 88,  'dateSortie' => '1994-06-15', 'idGenre' => $g5->idGenre]);
        $f6  = Film::create(['titreFil' => 'Harry Potter a l ecole des sorciers',  'descFil' => 'Harry Potter, jeune orphelin peu aime de ses tuteurs, decouvre le jour de ses onze ans qu il est sorcier et entre a Poudlard, une ecole de magie pleine de mysteres et de dangers.',                         'imgFil' => 'harrypotter.jpg',    'dureFil' => 152, 'dateSortie' => '2001-11-14', 'idGenre' => $g6->idGenre]);
        $f7  = Film::create(['titreFil' => 'Joker',                                'descFil' => 'Arthur Fleck, comedien rate et marginalise vivant a Gotham City, sombre progressivement dans la folie et se transforme en un criminel anarchiste connu sous le nom de Joker.',                                'imgFil' => 'joker.jpg',          'dureFil' => 122, 'dateSortie' => '2019-10-04', 'idGenre' => $g7->idGenre]);
        $f8  = Film::create(['titreFil' => 'Oppenheimer',                          'descFil' => 'Le film retrace la vie de J. Robert Oppenheimer, le physicien americain qui dirigea le projet Manhattan et participa a la creation de la premiere bombe atomique lors de la Seconde Guerre mondiale.',        'imgFil' => 'oppenheimer.jpg',    'dureFil' => 180, 'dateSortie' => '2023-07-19', 'idGenre' => $g4->idGenre]);
        $f9  = Film::create(['titreFil' => 'Barbie',                               'descFil' => 'Barbie mene une vie parfaite a Barbieland jusqu au jour ou une crise existentielle l oblige a partir explorer le monde reel avec Ken, decouvrant les complexites de l humanite.',                             'imgFil' => 'barbie.jpg',         'dureFil' => 114, 'dateSortie' => '2023-07-19', 'idGenre' => $g3->idGenre]);
        $f10 = Film::create(['titreFil' => 'Dune : Deuxieme Partie',               'descFil' => 'Paul Atreides poursuit sa quete de vengeance contre ceux qui ont detruit sa famille, unissant ses forces avec Chani et les Fremen pour mener une guerre sainte sur la planete Arrakis.',                     'imgFil' => 'dune2.jpg',          'dureFil' => 166, 'dateSortie' => '2024-02-28', 'idGenre' => $g2->idGenre]);
        $f11 = Film::create(['titreFil' => 'Super Mario Bros. le film',            'descFil' => 'Mario et son frere Luigi, deux plombiers de Brooklyn, sont aspires dans un monde fantastique et doivent traverser le Royaume Champignon pour sauver la princesse Peach des griffes de Bowser.',               'imgFil' => 'mario.jpg',          'dureFil' => 92,  'dateSortie' => '2023-04-05', 'idGenre' => $g5->idGenre]);
        $f12 = Film::create(['titreFil' => 'Spider-Man : Across the Spider-Verse', 'descFil' => 'Miles Morales part a l aventure dans le multivers et rencontre une equipe de Spider-Man, mais il se retrouve face a un dilemme qui menace tout ce qu il aime.',                                               'imgFil' => 'spiderverse2.jpg',   'dureFil' => 140, 'dateSortie' => '2023-05-31', 'idGenre' => $g5->idGenre]);
        $f13 = Film::create(['titreFil' => 'Wonka',                                'descFil' => 'Avant de devenir le legendaire chocolatier, le jeune Willy Wonka debarque en ville avec de grands reves et une magie culinaire unique, mais doit faire face a une dangereuse concurrence.',                  'imgFil' => 'wonka.jpg',          'dureFil' => 116, 'dateSortie' => '2023-12-13', 'idGenre' => $g3->idGenre]);
        $f14 = Film::create(['titreFil' => 'Napoleon',                             'descFil' => 'Portrait epique de Napoleon Bonaparte, de son ascension fulgurante au pouvoir a sa chute tragique, a travers ses grandes batailles et sa relation passionnelle et tumultueuse avec Josephine.',                'imgFil' => 'napoleon.jpg',       'dureFil' => 158, 'dateSortie' => '2023-11-22', 'idGenre' => $g4->idGenre]);
        $f15 = Film::create(['titreFil' => 'Rebel Moon - Partie 1',                'descFil' => 'Kora, une etrangere mysterieuse, doit rassembler une poignee de guerriers pour defendre une colonie paisible contre les forces impitoyables d un empire galactique qui cherche a les aneantir.',             'imgFil' => 'rebelmoon.jpg',      'dureFil' => 133, 'dateSortie' => '2023-12-22', 'idGenre' => $g2->idGenre]);
        $f16 = Film::create(['titreFil' => 'The Killer',                           'descFil' => 'Un tueur a gages froid et methodique voit sa vie basculer apres une mission qui tourne mal, le forcant a se retourner contre ses propres employeurs dans une traque impitoyable a travers le monde.',         'imgFil' => 'thekiller.jpg',      'dureFil' => 118, 'dateSortie' => '2023-11-10', 'idGenre' => $g1->idGenre]);
        $f17 = Film::create(['titreFil' => 'Aquaman et le Royaume perdu',          'descFil' => 'Aquaman doit forger une alliance improbable avec son frere emprisonne pour proteger Atlantis et le monde entier des plans devastateurs de Black Manta qui cherche a se venger.',                              'imgFil' => 'aquaman2.jpg',       'dureFil' => 124, 'dateSortie' => '2023-12-20', 'idGenre' => $g1->idGenre]);
        $f18 = Film::create(['titreFil' => 'Hunger Games : La Ballade',            'descFil' => 'Bien avant de devenir president tyrannique, le jeune Coriolanus Snow est choisi comme mentor lors des 10emes Jeux de la Faim, une experience qui va forger sa cruaute et ses ambitions.',                    'imgFil' => 'hungergames.jpg',    'dureFil' => 157, 'dateSortie' => '2023-11-15', 'idGenre' => $g1->idGenre]);
        $f19 = Film::create(['titreFil' => 'Gran Turismo',                         'descFil' => 'L incroyable histoire vraie de Jann Mardenborough, un jeune prodige du jeu video Gran Turismo qui realise son reve impossible de devenir pilote de course automobile professionnel.',                         'imgFil' => 'granturismo.jpg',    'dureFil' => 134, 'dateSortie' => '2023-08-09', 'idGenre' => $g1->idGenre]);
        $f20 = Film::create(['titreFil' => 'Indiana Jones et le Cadran',           'descFil' => 'Dans sa derniere grande aventure, Indiana Jones part a la recherche d un artefact legendaire capable de voyager dans le temps, pourchasse par des agents qui veulent s en emparer.',                         'imgFil' => 'indianajones5.jpg',  'dureFil' => 154, 'dateSortie' => '2023-06-28', 'idGenre' => $g1->idGenre]);
        $f21 = Film::create(['titreFil' => 'Mission : Impossible 7',               'descFil' => 'Ethan Hunt et son equipe affrontent leur mission la plus perilleuse en traquant une terrifiante arme d intelligence artificielle avant qu elle ne tombe entre de mauvaises mains.',                           'imgFil' => 'mi7.jpg',            'dureFil' => 163, 'dateSortie' => '2023-07-12', 'idGenre' => $g1->idGenre]);
        $f22 = Film::create(['titreFil' => 'Le Garcon et le Heron',                'descFil' => 'Apres la mort de sa mere, un jeune garcon decouvre une tour abandonnee qui l entraine dans un monde fantastique et mysterieux guide par un etrange heron cendre.',                                           'imgFil' => 'boyheron.jpg',       'dureFil' => 124, 'dateSortie' => '2023-11-01', 'idGenre' => $g5->idGenre]);
        $f23 = Film::create(['titreFil' => 'Wish : Asha et la bonne etoile',       'descFil' => 'Asha, une jeune fille au grand coeur vivant dans le royaume de Rosas, invoque une etoile magique pour aider son grand-pere a realiser son voeu et sauver les reves de tout un peuple.',                     'imgFil' => 'wish.jpg',           'dureFil' => 95,  'dateSortie' => '2023-11-29', 'idGenre' => $g5->idGenre]);
        $f24 = Film::create(['titreFil' => 'Superman',                             'descFil' => 'Clark Kent incarne les valeurs d esperance et de justice dans une nouvelle aventure epique qui redefinit l univers DC, sous la vision du realisateur James Gunn.',                                            'imgFil' => 'supermanlegacy.jpg', 'dureFil' => 140, 'dateSortie' => '2026-07-11', 'idGenre' => $g1->idGenre]);
        $f25 = Film::create(['titreFil' => 'Un film Minecraft',                    'descFil' => 'Quatre joueurs atypiques sont mysterieusement aspires dans le monde cubique de Minecraft et doivent survivre ensemble pour retrouver leur chemin vers chez eux.',                                             'imgFil' => 'minecraft.jpg',      'dureFil' => 100, 'dateSortie' => '2026-04-02', 'idGenre' => $g5->idGenre]);
        $f26 = Film::create(['titreFil' => 'Mickey 17',                            'descFil' => 'Mickey Barnes accepte une mission suicidaire comme employe jetable lors d une expedition spatiale, mais se retrouve en conflit avec son propre clone lors d une mission qui tourne tres mal.',                'imgFil' => 'mickey17.jpg',       'dureFil' => 139, 'dateSortie' => '2026-05-29', 'idGenre' => $g2->idGenre]);
        $f27 = Film::create(['titreFil' => 'Tron: Ares',                           'descFil' => 'Ares, un programme issu de la Grille numerique, s infiltre pour la premiere fois dans le monde reel, declenchant une confrontation explosive entre les deux univers aux consequences imprevisibles.',         'imgFil' => 'tronares.jpg',       'dureFil' => 130, 'dateSortie' => '2026-10-10', 'idGenre' => $g2->idGenre]);

        // 3. CINEMAS
        $c1 = Cinema::create(['nomCin' => 'Cinema Centre Ville', 'adrCin' => '10 rue de la Republique', 'cpCin' => '75001', 'vilCin' => 'Paris']);
        $c2 = Cinema::create(['nomCin' => 'Mega CGR Lyon',       'adrCin' => '25 avenue Lumiere',        'cpCin' => '69008', 'vilCin' => 'Lyon']);
        $c3 = Cinema::create(['nomCin' => 'Pathe Marseille',     'adrCin' => '3 boulevard Dugommier',    'cpCin' => '13001', 'vilCin' => 'Marseille']);

        // 4. TYPES DE SALLE
        $ts1 = TypeSalle::create(['libTypSal' => 'Classique']);
        $ts2 = TypeSalle::create(['libTypSal' => 'IMAX']);
        $ts3 = TypeSalle::create(['libTypSal' => '4DX']);
        $ts4 = TypeSalle::create(['libTypSal' => 'Dolby Cinema']);

        // 5. SALLES
        $sal1 = Salle::create(['numSal' => 1, 'nbPlace' => 120, 'idCin' => $c1->idCin, 'idTyp' => $ts1->idTyp]);
        $sal2 = Salle::create(['numSal' => 2, 'nbPlace' => 200, 'idCin' => $c1->idCin, 'idTyp' => $ts2->idTyp]);
        $sal3 = Salle::create(['numSal' => 1, 'nbPlace' => 150, 'idCin' => $c2->idCin, 'idTyp' => $ts1->idTyp]);
        $sal4 = Salle::create(['numSal' => 2, 'nbPlace' => 80,  'idCin' => $c2->idCin, 'idTyp' => $ts3->idTyp]);
        $sal5 = Salle::create(['numSal' => 1, 'nbPlace' => 180, 'idCin' => $c3->idCin, 'idTyp' => $ts4->idTyp]);
        $sal6 = Salle::create(['numSal' => 2, 'nbPlace' => 100, 'idCin' => $c3->idCin, 'idTyp' => $ts1->idTyp]);

        // 6. TYPES DE SEANCE
        $tsea1 = TypeSeance::create(['libTypeSea' => 'VF']);
        $tsea2 = TypeSeance::create(['libTypeSea' => 'VOSTFR']);
        $tsea3 = TypeSeance::create(['libTypeSea' => 'VO']);

        // 7. LANGUES
        $lFr = Langue::create(['LangueSea' => 'Francais']);
        $lEn = Langue::create(['LangueSea' => 'Anglais']);
        $lEs = Langue::create(['LangueSea' => 'Espagnol']);
        $lJa = Langue::create(['LangueSea' => 'Japonais']);

        // 8. TARIFS
        Tarif::create(['libTar' => 'Plein tarif',  'prixTar' => 12.50, 'idTypeSea' => $tsea1->idTypeSea]);
        Tarif::create(['libTar' => 'Etudiant',     'prixTar' => 8.00,  'idTypeSea' => $tsea1->idTypeSea]);
        Tarif::create(['libTar' => 'Moins 14 ans', 'prixTar' => 6.50,  'idTypeSea' => $tsea1->idTypeSea]);
        Tarif::create(['libTar' => 'Senior',       'prixTar' => 9.00,  'idTypeSea' => $tsea1->idTypeSea]);
        Tarif::create(['libTar' => 'Plein tarif',  'prixTar' => 13.00, 'idTypeSea' => $tsea2->idTypeSea]);
        Tarif::create(['libTar' => 'Etudiant',     'prixTar' => 9.00,  'idTypeSea' => $tsea2->idTypeSea]);
        Tarif::create(['libTar' => 'Plein tarif',  'prixTar' => 11.50, 'idTypeSea' => $tsea3->idTypeSea]);
        Tarif::create(['libTar' => 'Etudiant',     'prixTar' => 8.50,  'idTypeSea' => $tsea3->idTypeSea]);

        // 9. SEANCES
        Seance::create(['dateHeurSea' => '2026-05-10 10:00:00', 'idFil' => $f1->idFil,  'idSal' => $sal1->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-10 14:00:00', 'idFil' => $f1->idFil,  'idSal' => $sal1->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-10 18:00:00', 'idFil' => $f1->idFil,  'idSal' => $sal2->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-10 11:00:00', 'idFil' => $f2->idFil,  'idSal' => $sal2->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-11 21:00:00', 'idFil' => $f2->idFil,  'idSal' => $sal3->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-11 14:00:00', 'idFil' => $f3->idFil,  'idSal' => $sal1->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-12 17:00:00', 'idFil' => $f3->idFil,  'idSal' => $sal6->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-11 20:00:00', 'idFil' => $f4->idFil,  'idSal' => $sal1->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-05-13 20:30:00', 'idFil' => $f4->idFil,  'idSal' => $sal3->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-03-12 16:30:00', 'idFil' => $f5->idFil,  'idSal' => $sal2->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-14 10:00:00', 'idFil' => $f5->idFil,  'idSal' => $sal4->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-12 14:00:00', 'idFil' => $f6->idFil,  'idSal' => $sal1->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-12 19:00:00', 'idFil' => $f7->idFil,  'idSal' => $sal3->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-13 15:00:00', 'idFil' => $f8->idFil,  'idSal' => $sal5->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-13 18:30:00', 'idFil' => $f9->idFil,  'idSal' => $sal1->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-14 20:00:00', 'idFil' => $f10->idFil, 'idSal' => $sal2->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-14 14:00:00', 'idFil' => $f11->idFil, 'idSal' => $sal3->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-15 11:00:00', 'idFil' => $f12->idFil, 'idSal' => $sal4->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-15 16:00:00', 'idFil' => $f13->idFil, 'idSal' => $sal6->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-15 21:00:00', 'idFil' => $f14->idFil, 'idSal' => $sal5->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-16 19:00:00', 'idFil' => $f15->idFil, 'idSal' => $sal2->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-16 21:30:00', 'idFil' => $f16->idFil, 'idSal' => $sal1->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-17 18:00:00', 'idFil' => $f17->idFil, 'idSal' => $sal3->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-17 20:30:00', 'idFil' => $f18->idFil, 'idSal' => $sal5->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-18 15:30:00', 'idFil' => $f19->idFil, 'idSal' => $sal4->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-18 18:00:00', 'idFil' => $f20->idFil, 'idSal' => $sal6->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-19 21:00:00', 'idFil' => $f21->idFil, 'idSal' => $sal2->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-19 14:30:00', 'idFil' => $f22->idFil, 'idSal' => $sal1->idSal, 'idTypeSea' => $tsea3->idTypeSea, 'idLangue' => $lJa->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-20 10:30:00', 'idFil' => $f23->idFil, 'idSal' => $sal3->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-21 14:00:00', 'idFil' => $f11->idFil, 'idSal' => $sal4->idSal, 'idTypeSea' => $tsea1->idTypeSea, 'idLangue' => $lFr->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-21 21:00:00', 'idFil' => $f16->idFil, 'idSal' => $sal2->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);
        Seance::create(['dateHeurSea' => '2026-07-22 18:30:00', 'idFil' => $f8->idFil,  'idSal' => $sal6->idSal, 'idTypeSea' => $tsea2->idTypeSea, 'idLangue' => $lEn->idLangue]);

        // 10. ROLES DES PERSONNES
        $rReal  = RolePersonne::create(['libRolePer' => 'Realisateur']);
        $rActe  = RolePersonne::create(['libRolePer' => 'Acteur principal']);
        $rActe2 = RolePersonne::create(['libRolePer' => 'Acteur secondaire']);
        $rProd  = RolePersonne::create(['libRolePer' => 'Producteur']);
        $rSce   = RolePersonne::create(['libRolePer' => 'Scenariste']);

        // 11. PERSONNES
        $pStahelski   = Personne::create(['nomPer' => 'Stahelski',   'prenomPer' => 'Chad',        'dateNaisPer' => '1968-09-20', 'bioPer' => 'Realisateur americain et ancien cascadeur, connu pour avoir dirige la saga John Wick.',                                'lieuNaisPer' => 'Kirkland, USA']);
        $pReeves      = Personne::create(['nomPer' => 'Reeves',      'prenomPer' => 'Keanu',       'dateNaisPer' => '1964-09-02', 'bioPer' => 'Acteur americano-canadien polyvalent, celebre dans le monde entier pour ses roles dans Matrix et John Wick.',           'lieuNaisPer' => 'Beyrouth, Liban']);
        $pKolstad     = Personne::create(['nomPer' => 'Kolstad',     'prenomPer' => 'Derek',       'dateNaisPer' => '1977-01-01', 'bioPer' => 'Scenariste americain, createur de l univers John Wick et auteur de nombreux scripts de films d action.',                'lieuNaisPer' => 'USA']);
        $pCameron     = Personne::create(['nomPer' => 'Cameron',     'prenomPer' => 'James',       'dateNaisPer' => '1954-08-16', 'bioPer' => 'Realisateur et scenariste canadien, auteur de Titanic et Avatar, deux des plus grands succes du cinema mondial.',        'lieuNaisPer' => 'Kapuskasing, Canada']);
        $pWorthington = Personne::create(['nomPer' => 'Worthington', 'prenomPer' => 'Sam',         'dateNaisPer' => '1976-08-02', 'bioPer' => 'Acteur australien revele au grand public grace a son role principal de Jake Sully dans la saga Avatar.',                 'lieuNaisPer' => 'Godalming, Angleterre']);
        $pOury        = Personne::create(['nomPer' => 'Oury',        'prenomPer' => 'Gerard',      'dateNaisPer' => '1919-04-29', 'bioPer' => 'Realisateur et scenariste francais, maitre de la comedie populaire avec La Grande Vadrouille.',                          'lieuNaisPer' => 'Paris, France']);
        $pDeFunes     = Personne::create(['nomPer' => 'De Funes',    'prenomPer' => 'Louis',       'dateNaisPer' => '1914-07-31', 'bioPer' => 'Acteur comique francais iconique, l une des plus grandes stars du cinema europeen des annees 60 et 70.',                 'lieuNaisPer' => 'Courbevoie, France']);
        $pBourvil     = Personne::create(['nomPer' => 'Bourvil',     'prenomPer' => 'Andre',       'dateNaisPer' => '1917-07-27', 'bioPer' => 'Acteur et chanteur comique francais tres populaire, partenaire memorable de Louis de Funes dans La Grande Vadrouille.', 'lieuNaisPer' => 'Pretot-Vicquemare, France']);
        $pNolan       = Personne::create(['nomPer' => 'Nolan',       'prenomPer' => 'Christopher', 'dateNaisPer' => '1970-07-30', 'bioPer' => 'Realisateur et scenariste britannique visionnaire, auteur de Inception, Interstellar et Oppenheimer.',                   'lieuNaisPer' => 'Londres, Angleterre']);
        $pMurphy      = Personne::create(['nomPer' => 'Murphy',      'prenomPer' => 'Cillian',     'dateNaisPer' => '1976-05-25', 'bioPer' => 'Acteur irlandais oscarise pour son interpretation magistrale du physicien J. Robert Oppenheimer en 2024.',               'lieuNaisPer' => 'Douglas, Irlande']);
        $pPhillips    = Personne::create(['nomPer' => 'Phillips',    'prenomPer' => 'Todd',        'dateNaisPer' => '1970-12-20', 'bioPer' => 'Realisateur et scenariste americain, reconnu pour Joker qui a remporte le Lion d Or au Festival de Venise.',              'lieuNaisPer' => 'New York, USA']);
        $pPhoenix     = Personne::create(['nomPer' => 'Phoenix',     'prenomPer' => 'Joaquin',     'dateNaisPer' => '1974-10-28', 'bioPer' => 'Acteur americain oscarise, connu pour ses performances intenses et habitees dans Joker et Her.',                          'lieuNaisPer' => 'San Juan, Porto Rico']);
        $pGerwig      = Personne::create(['nomPer' => 'Gerwig',      'prenomPer' => 'Greta',       'dateNaisPer' => '1983-08-04', 'bioPer' => 'Realisatrice et scenariste americaine, auteure du phenomene Barbie qui a battu des records mondiaux au box-office.',      'lieuNaisPer' => 'Sacramento, USA']);
        $pVilleneuve  = Personne::create(['nomPer' => 'Villeneuve',  'prenomPer' => 'Denis',       'dateNaisPer' => '1967-10-03', 'bioPer' => 'Realisateur quebecois de renommee mondiale, auteur de Blade Runner 2049 et de la brillante adaptation de Dune.',         'lieuNaisPer' => 'Gentilly, Canada']);
        $pChalamet    = Personne::create(['nomPer' => 'Chalamet',    'prenomPer' => 'Timothee',    'dateNaisPer' => '1995-12-27', 'bioPer' => 'Acteur franco-americain, l une des grandes stars de sa generation, revele dans Call Me By Your Name.',                   'lieuNaisPer' => 'New York, USA']);
        $pMiyazaki    = Personne::create(['nomPer' => 'Miyazaki',    'prenomPer' => 'Hayao',       'dateNaisPer' => '1941-01-05', 'bioPer' => 'Maitre de l animation japonaise et cofondateur du Studio Ghibli, auteur du legendaire Voyage de Chihiro.',                'lieuNaisPer' => 'Tokyo, Japon']);
        $pPattinson   = Personne::create(['nomPer' => 'Pattinson',   'prenomPer' => 'Robert',      'dateNaisPer' => '1986-05-13', 'bioPer' => 'Acteur britannique polyvalent, connu pour Twilight puis pour ses roles exigeants dans des films d auteur ambitieux.',     'lieuNaisPer' => 'Londres, Angleterre']);
        $pBongJoonho  = Personne::create(['nomPer' => 'Bong',        'prenomPer' => 'Joon-ho',     'dateNaisPer' => '1969-09-14', 'bioPer' => 'Realisateur et scenariste sud-coreen, premier non-anglophone a remporter l Oscar du meilleur film avec Parasite en 2020.', 'lieuNaisPer' => 'Daegu, Coree du Sud']);

        // 12. PARTICIPE
        Participe::create(['idPer' => $pStahelski->idPer,   'idFil' => $f1->idFil,  'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pReeves->idPer,      'idFil' => $f1->idFil,  'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pKolstad->idPer,     'idFil' => $f1->idFil,  'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pCameron->idPer,     'idFil' => $f2->idFil,  'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pWorthington->idPer, 'idFil' => $f2->idFil,  'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pCameron->idPer,     'idFil' => $f2->idFil,  'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pOury->idPer,        'idFil' => $f3->idFil,  'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pDeFunes->idPer,     'idFil' => $f3->idFil,  'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pBourvil->idPer,     'idFil' => $f3->idFil,  'idRolePer' => $rActe2->idRolePer]);
        Participe::create(['idPer' => $pOury->idPer,        'idFil' => $f3->idFil,  'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pNolan->idPer,       'idFil' => $f8->idFil,  'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pMurphy->idPer,      'idFil' => $f8->idFil,  'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pNolan->idPer,       'idFil' => $f8->idFil,  'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pPhillips->idPer,    'idFil' => $f7->idFil,  'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pPhoenix->idPer,     'idFil' => $f7->idFil,  'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pPhillips->idPer,    'idFil' => $f7->idFil,  'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pGerwig->idPer,      'idFil' => $f9->idFil,  'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pGerwig->idPer,      'idFil' => $f9->idFil,  'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pVilleneuve->idPer,  'idFil' => $f10->idFil, 'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pChalamet->idPer,    'idFil' => $f10->idFil, 'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pVilleneuve->idPer,  'idFil' => $f10->idFil, 'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pMiyazaki->idPer,    'idFil' => $f22->idFil, 'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pMiyazaki->idPer,    'idFil' => $f22->idFil, 'idRolePer' => $rSce->idRolePer]);
        Participe::create(['idPer' => $pBongJoonho->idPer,  'idFil' => $f26->idFil, 'idRolePer' => $rReal->idRolePer]);
        Participe::create(['idPer' => $pPattinson->idPer,   'idFil' => $f26->idFil, 'idRolePer' => $rActe->idRolePer]);
        Participe::create(['idPer' => $pBongJoonho->idPer,  'idFil' => $f26->idFil, 'idRolePer' => $rSce->idRolePer]);

        //ajout d'utilisateur de test Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('0123456'),
            'role' => 'admin',
        ]);
    }
}
