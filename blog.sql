--
-- Base de données :  `blog`
--

--
-- Structure de la table `usager`
---

DROP TABLE IF EXISTS usager;
CREATE TABLE IF NOT EXISTS usager 
(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(50) NOT NULL,
    motDePasse varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `usager`
--

INSERT INTO usager (id, nom, motDePasse) VALUES
(1, 'GuillaumeH', '$2y$10$xQbHtr.CVILoJv.F1mSose0BDRxeMG00x5b3TyUXqaqbT04g.XGxW'),
(2, 'Simone', '$2y$10$kw3V5ocJPcihuaqlj3UPIuR0.T09I9jp5DQPHi4d.paQwjCnwtSK2');

-------------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS article;
CREATE TABLE IF NOT EXISTS article 
(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titre varchar(100) NOT NULL,
    texte longtext NOT NULL,
    idUsager int(11) NOT NULL, 
    FOREIGN KEY (idUsager) references usager(id)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO article (id, titre, texte, idUsager) VALUES
(1, "Le point de croix, dommage collatéral inattendu mais bien réel de la guerre en Ukraine", "Depuis le début de «l'opération spéciale» menée par la Russie en Ukraine, les marques occidentales ont rapidement fui le pays, compliquant la vie des Russes qui souhaitaient s'acheter une voiture, des meubles, des téléphones ou des vêtements. Mais le changement a aussi eu des répercussions conséquentes sur certains secteurs plus inattendus.Au début du mois de mars, après l'annonce par PayPal de la fermeture de tous ses services en Russie, Etsy a suspendu de sa plateforme les boutiques russes «en raison de l'expansion des restrictions commerciales, y compris l'arrêt des opérations de plusieurs processeurs de paiement et de cartes de crédit en Biélorussie et en Russie». C'est ainsi que de nombreux fans occidentaux du point de croix (un loisir qui consiste à broder des points en forme de «X» pour réaliser divers motifs) ont découvert que beaucoup de leurs créateurs de modèles favoris étaient russes.", 1),

(2, "Neuf fois sur dix, Instagram n'agit pas en cas de cyberharcèlement misogyne", "En septembre 2021, les études internes commandées par Facebook au sujet des méfaits d'Instagram sur ses utilisateurs, et particulièrement sur les jeunes filles, avaient résonné comme un coup de tonnerre dans le monde entier. Instagram mettrait à mal la santé mentale des jeunes et aurait une influence particulièrement néfaste sur l'image corporelle de ses utilisatrices. Si ces révélations en avaient scandalisé plus d'un, les résultats de l'étude donnaient alors l'espoir d'une plus grande vigilance de la part du réseau social américain. Et pourtant. Une récente étude menée par le Center for Countering Digital Hate (CCDH, «centre de lutte contre la haine numérique» en français), une association à but non lucratif axée sur l'analyse de la désinformation sur internet et du cyberharcèlement, rend compte d'un constat tout aussi alarmant, rapporte le Washington Post. Reposant sur près de 8.700 messages haineux reçus par cinq femmes d'influence (dont l'actrice américaine Amber Heard) cette étude dévoile que, malgré les signalements des utilisatrices, Instagram n'a pas agi dans 90% des cas. Autrement dit, sur dix signalements, neuf sont restés sans réponse de la part des modérateurs. Une statistique édifiante que l'association considère comme un des éléments illustrant «une épidémie de harcèlement misogyne».", 1),

(3, "La guerre en Ukraine va-t-elle accélérer la transition énergétique?", "Le GIEC a publié ce lundi 4 avril le dernier volet de son sixième rapport alarmant sur les conséquences du changement climatique. Au même moment, l'administration de Joe Biden s'est donné pour priorité de fournir les États européens en énergies afin de les aider à sortir de leur dépendance au gaz russe. Le site d'infos NPR s'est donc intéressé à la manière dont la guerre en Ukraine pourrait impacter la transition énergétique.Le rapport du GIEC est clair: il faut immédiatement changer nos modes de production d'énergie pour du renouvelable si l'on veut réduire nos émissions de dioxyde de carbone. Certains activistes pour le climat voient dans la situation actuelle avec l'Ukraine une opportunité de les changer drastiquement. Il s'agirait d'en profiter pour faire le point sur la nécessité des énergies renouvelables en matière de sécurité nationale. «Je pense qu'il y a des chances pour que dans le futur, nous regardions cette crise comme un accélérateur de la transition énergétique», confie Jason Bordoff, chercheur à l'Université Columbia. Selon plusieurs experts, tout va se jouer dans le choix des gouvernements: il s'agira soit de prioriser le besoin immédiat en énergie fossiles, soit d'opérer un changement à long terme de leurs techniques de production.", 2),

(4, "Le cuir de pomme, nouvelle tendance végane", "Le cuir se réinvente et la mode devient plus responsable. Alors que les cuirs de champignons, d'ananas et de coco font parler d'eux, un petit dernier entre en scène chez certaines marques: le cuir de pomme. Sous-produit de l'industrie du jus de pomme, ce cuir est fabriqué à partir de la réutilisation de noyaux et de peaux. Transformés sous forme de pâtes, ces éléments sont ensuite mélangés avec des solvants organiques et du polyuréthane pour donner un rendu similaire au cuir. Des marques de luxe comme Sylven New York, Samara ou Good Guys Don't Wear Leather se sont emparées de cette variante végétale pour en faire le matériau phare de leurs nouvelles collections. Ces alternatives plus responsables séduisent à la fois les designers et les consommateurs qui veulent éviter l'exploitation animale. Ils utilisaient jusqu'ici du cuir synthétique, mais ce dernier, composé à 100% de polyuréthane, un combustible fossile particulièrement nocif pour la planète, n'est pas très écologique. En revanche, le cuir de pomme ne nécessite que 40 à 50% de plastique et réduit même les émissions de gaz à effet de serre en réutilisant des déchets alimentaires.", 2),

(5, "Les mystères du cratère des Pingualuit, 'œil de cristal' à l'eau pure", "Il est situé dans la localité de Kangiqsujuaq, au nord du Québec. L'aventurière et photographe Phoebe Smith s'y est rendue pour la BBC afin de rapporter les histoires que l'on raconte sur ce cratère de plus de 400 mètres de profondeur, 3,5 kilomètres de diamètre et d'une circonférence d'environ 10 kilomètres. Le cratère des Pingualuit se distingue par son apparente symétrie: il forme un cercle presque parfait. Pierre Phillie est géographe culturel et s'intéresse donc aux liens entre les sociétés et leur environnement. Ce Français installé depuis plus de quarante ans aux abords du cratère possède une copie d'une photo prise le 20 juin 1943 par un officier de l'armée de l'air américaine. Il raconte: «Le monde occidental a découvert le cratère cette année-là, pendant la Seconde Guerre mondiale, alors que les pilotes l'utilisaient comme repère géographique. Mais ils n'ont pas partagé la découverte avec le reste du monde avant la fin de la guerre.» La première théorie à propos du mystérieux «œil de cristal», comme le surnomment les Inuits, fut celle de Fred W. Chubb. En 1950, ce prospecteur de l'Ontario était convaincu que le cratère était causé par un volcan et qu'il renfermait donc certainement des diamants. «Nous savons désormais sans aucun doute qu'il s'agit bien de l'impact d'une météorite», rectifie Pierre Philie. Et de préciser: «On estime que l'impact a été 8.500 fois plus violent que la bombe atomique lâchée sur Hiroshima.»", 1),

(6, "Certains édulcorants favoriseraient le développement de cancers", "L'idée que les édulcorants sont mauvais pour la santé n'est pas nouvelle. Des études ont d'ailleurs établi un lien entre leur consommation excessive et des pathologies telles que l'obésité, le diabète de type 2 et les maladies cardiovasculaires. Mais les liens avec le cancer restaient plus incertains. Il avait par exemple été démontré qu'un édulcorant artificiel, le cyclamate (E952), augmentait le risque de cancer de la vessie et d'atrophie testiculaire chez les rats. Cependant, la physiologie humaine étant différente de celle des rats, il n'a pas été possible ensuite de trouver un lien équivalent entre cet édulcorant et ces risques chez l'homme. Malgré cela, les médias ont continué à faire état d'un lien entre édulcorants et cancer. Mais aujourd'hui, une récente étude française publiée dans PLOS Medicine, menée sur 102.865 adultes (cohorte NutriNet-Santé), apporte de nouvelles données [les participants étaient répartis en trois groupes, non consommateur, faibles consommateurs et grands consommateurs d'édulcorants, ce dernier groupe étant lui-même subdivisé en deux selon le sexe, ndlr]. Cet important travail d'analyse statistique a montré que les personnes qui consomment des niveaux élevés de certains édulcorants présentent effectivement une légère augmentation du risque de développer plusieurs types de cancers. Pour évaluer leur consommation d'édulcorants artificiels, les chercheurs ont demandé aux participants de tenir un journal alimentaire (antécédents médicaux, mode de vie, étaient également renseignés, entre autres paramètres). Environ la moitié des participants ont été suivis pendant plus de huit ans. L'étude a révélé que l'aspartame (E951) et l'acésulfame-K (E950), en particulier, sont associés à un risque accru notamment de cancer du sein et des cancers liés à l'obésité: cancers colorectaux, de l'estomac et de la prostate. Cela suggère que la suppression de certains types d'édulcorants de votre alimentation pourrait réduire le risque de cancer.", 2);