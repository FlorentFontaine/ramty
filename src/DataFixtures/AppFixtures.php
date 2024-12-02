<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Chat;
use App\Entity\City;
use App\Entity\Step;
use App\Entity\Team;
use App\Entity\Tool;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Level;
use App\Entity\Staff;
use App\Entity\Sector;
use App\Entity\Address;
use App\Entity\Channel;
use App\Entity\Comment;
use App\Entity\Country;
use App\Entity\TypeJob;
use App\Entity\Compagny;
use App\Entity\Criteria;
use App\Entity\Document;
use App\Entity\Platform;
use App\Entity\Priority;
use App\Entity\TypeStep;
use App\Entity\StatusJob;
use App\Entity\TypeAlert;
use App\Entity\TypeEvent;
use App\Entity\TypeLevel;
use App\Entity\TypeStaff;
use App\Entity\Competence;
use App\Entity\StatusStep;
use App\Entity\StatusAlert;
use App\Entity\StatusEvent;
use App\Entity\TypeCriteria;
use App\Entity\TypeDocument;
use App\Entity\TypeResearch;
use App\Entity\TypeCandidacy;
use App\Entity\TypeCompetence;
use App\Entity\StatusCandidacy;
use App\Entity\TypeConfigResearch;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $today = new \DateTimeImmutable();

        $compagny = new Compagny();
        $compagny->setName("Konexty");
        $compagny->setCreatedAt($today);
        $compagny->setActive(true);
        $manager->persist($compagny);
        $manager->flush();

        $user = new User();
        $user->setUsername("Antoine Fontaine");
        $user->setEmail("admin@konexty.com");
        $user->setPhone("0616262167");
        $user->setActive(true);
        $user->setPassword($this->passwordEncoder->hashPassword($user, "Suikoden02!"));
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setCompagny($compagny);
        $user->setIsVerified(true);
        $manager->persist($user);
        $manager->flush();

        return;

        // si on est en prod, on ne charge pas les fixtures
        if ($_ENV['APP_ENV'] === 'prod') {
            return;
        }

        $platForm = ["Indeed", "Monster", "Pole Emploi", "Apec", "Linkedin", "Viadeo", "Autre"];

        foreach ($platForm as $platform) {
            $newPlatform = new Platform();
            $newPlatform->setName($platform);
            $manager->persist($newPlatform);
        }

        $priorities = [
            1 => "Basse", 
            2 => "Moyenne",
            3 => "Haute", 
            4 => "Urgente"
        ];

        foreach ($priorities as $position => $priority) {
            $newPriority = new Priority();
            $newPriority->setName($priority);
            $newPriority->setPosition($position);
            $manager->persist($newPriority);
        }


        $typeEvent = [
            1 => "Rendez-vous",
            2 => "Réunion",
            3 => "Entretien téléphonique",
            4 => "Entretien physique",
            5 => "Avis",
            6 => "Contacts Références",
            7 => "Prise de référence",
            8 => "Estimation salaire",
            9 => "Refus proposition emb.",
            10 => "Arrivée",
            11 => "Création FC",
            12 => "Départ"
        ];

        foreach ($typeEvent as $position => $type) {
            $newTypeEvent = new TypeEvent();
            $newTypeEvent->setName($type);
            $newTypeEvent->setPosition($position);

            $manager->persist($newTypeEvent);
        }

        $typeCandidacy = [
            1 => "Candidature spontanée",
            2 => "Réponse à une offre",
            3 => "Candidature via un cabinet de recrutement",
            4 => "Candidature via un site d'emploi",
            5 => "Candidature via un réseau social",
            6 => "Candidature via un salon",
            7 => "Candidature via un forum",
            8 => "Candidature via un événement",
            9 => "Candidature via un autre moyen"
        ];

        foreach ($typeCandidacy as  $position => $type) {
            $newTypeCandidacy = new TypeCandidacy();
            $newTypeCandidacy->setName($type);
            $newTypeCandidacy->setPosition($position);
            $manager->persist($newTypeCandidacy);
        }

        $typeCompetence = [
            1 => "Capacité d’adaptation",
            2 => "L’agilité avec une capacité à pouvoir travailler en hybride",
            3 => "Savoir communiquer en milieu virtuel",
            4 => "La créativité et la capacité d’initiative",
            5 => "La communication / sens du relationnel",
            6 => "La coopération et le travail en équipe",
            7 => "L’esprit critique",
            8 => "L’autonomie",
            9 => "Capacité à s’organiser, prioriser les tâches",
            10 => "Prise de décision et sens des responsabilités"
        ];

        foreach ($typeCompetence as $position =>  $type) {
            $newTypeCompetence = new TypeCompetence();
            $newTypeCompetence->setName($type);
            $newTypeCompetence->setPosition($position);
            $manager->persist($newTypeCompetence);
        }

        $typeDocument = [
            1 => "CV",
            2 => "Lettre de motivation",
            3 => "Diplôme",
            4 => "Certificat",
            5 => "Attestation",
            6 => "Autre"
        ];

        foreach ($typeDocument as $position =>  $type) {
            $newTypeDocument = new TypeDocument();
            $newTypeDocument->setName($type);
            $newTypeDocument->setPosition($position);
            $manager->persist($newTypeDocument);
        }

        $typeCriteria = [
            1 => "Compétences",
            2 => "Expérience",
            3 => "Formation",
            4 => "Personnalité",
            5 => "Motivation",
            6 => "Autre"
        ];

        foreach ($typeCriteria as $position => $type) {
            $newTypeCriteria = new TypeCriteria();
            $newTypeCriteria->setName($type);
            $newTypeCriteria->setPosition($position);
            $manager->persist($newTypeCriteria);
        }

        $typeJob = [
            1 => "Education",
            2 => "Finance",
            3 => "Gestion",
            4 => "Informatique",
            5 => "Juridique",
            6 => "Logistique",
            7 => "Management",
            8 => "Marketing",
            9 => "Ressources Humaines",
            10 => "Santé",
            11 => "Sécurité",
            12 => "Vente",
            13 => "Tourisme",
            14 => "Design, Art et Multimédia",
            15 => "Services client",
            16 => "Gouvernement",
            17 => "Mécanique",
            18 => "Rédaction",
            19 => "Autre"
        ];

        foreach ($typeJob as  $position => $type) {
            $newTypeJob = new TypeJob();
            $newTypeJob->setName($type);
            $newTypeJob->setPosition($position);
            $manager->persist($newTypeJob);
        }

        $typeStaff = [
            1 => "Vivier",
            2 => "Salarié",
            3 => "Candidat",
            4 => "Collaborateur",
            5 => "Partenaire",
            6 => "Prestataire",
            7 => "Autre"
        ];

        foreach ($typeStaff as $position => $type) {
            $newTypeStaff = new TypeStaff();
            $newTypeStaff->setName($type);
            $newTypeStaff->setPosition($position);
            $manager->persist($newTypeStaff);
        }

        $typeStep = [
            1 => "Appel",
            2 => "Mail",
            3 => "Entretien",
            4 => "Avis",
            5 => "Test",
            6 => "Autre"
        ];

        foreach ($typeStep as $position => $type) {
            $newTypeStep = new TypeStep();
            $newTypeStep->setName($type);
            $newTypeStep->setPosition($position);
            $manager->persist($newTypeStep);
        }

        $typeResearch = [
            1 => "Appel d'offre",
            2 => "Recrutement interne",
            3 => "Recrutement externe",
            4 => "Besoin client",
            5 => "Autre"
        ];

        foreach ($typeResearch as $position => $type) {
            $newTypeResearch = new TypeResearch();
            $newTypeResearch->setName($type);
            $newTypeResearch->setPosition($position);
            $manager->persist($newTypeResearch);
        }

        $typeConfigResearch = [
            1 => "Supérieur à",
            2 => "Inférieur à",
            3 => "Egal à",
            4 => "Entre"
        ];

        foreach ($typeConfigResearch as $position => $type) {
            $newTypeConfigResearch = new TypeConfigResearch();
            $newTypeConfigResearch->setOperator($type);
            $newTypeConfigResearch->setPosition($position);
            $manager->persist($newTypeConfigResearch);
        }

        $typeAlert = [
            1 => "Mail",
            2 => "SMS",
            3 => "Notification",
            4 => "Autre"
        ];

        foreach ($typeAlert as $position => $type) {
            $newTypeAlert = new TypeAlert();
            $newTypeAlert->setName($type);
            $newTypeAlert->setPosition($position);
            $manager->persist($newTypeAlert);
        }

        $typeLevel = [
            1 => "Débutant",
            2 => "Intermédiaire",
            3 => "Avancé",
            4 => "Expert"
        ];

        foreach ($typeLevel as $position => $type) {
            $newTypeLevel = new TypeLevel;
            $newTypeLevel->setName($type);
            $newTypeLevel->setPosition($position);
            $manager->persist($newTypeLevel);
        }

        $status = [
            1 =>"Nouveau",
            2 =>"En cours",
            3 =>"Attente",
            4 =>"Terminé",
            5 =>"Annulé"
        ];

        foreach ($status as $position => $statut) {
            $newStatus = new StatusAlert();
            $newStatus->setName($statut);
            $newStatus->setPosition($position);
            $manager->persist($newStatus);

            $newStatus = new StatusCandidacy();
            $newStatus->setName($statut);
            $newStatus->setPosition($position);
            $manager->persist($newStatus);

            $newStatus = new StatusEvent();
            $newStatus->setName($statut);
            $newStatus->setPosition($position);
            $manager->persist($newStatus);

            $newStatus = new StatusJob();
            $newStatus->setName($statut);
            $newStatus->setPosition($position);
            $manager->persist($newStatus);

            $newStatus = new StatusStep();
            $newStatus->setName($statut);
            $newStatus->setPosition($position);
            $manager->persist($newStatus);
        }

        $manager->flush();

        $faker = Factory::create("fr_FR");

        for ($j = 1; $j <= 5; $j++) {
            $compagny = new Compagny();
            $compagny->setName($faker->company);
            $compagny->setCreatedAt($today);
            $compagny->setActive(true);
            $manager->persist($compagny);
            $manager->flush();

            $chat = new Chat();
            $chat->setCompagny($compagny);
            $manager->persist($chat);
            $manager->flush();

            $channelGeneral = new Channel();
            $channelGeneral->setName("Général");
            $channelGeneral->setChat($chat);
            $manager->persist($channelGeneral);

            $channelRH = new Channel();
            $channelRH->setName("Ressources Humaines");
            $channelRH->setChat($chat);
            $manager->persist($channelRH);

            $channelDev = new Channel();
            $channelDev->setName("Développement");
            $channelDev->setChat($chat);
            $manager->persist($channelDev);

            $channelMarketing = new Channel();
            $channelMarketing->setName("Marketing");
            $channelMarketing->setChat($chat);
            $manager->persist($channelMarketing);
            $manager->flush();

            $teamDirection = new Team();
            $teamDirection->setName("Direction");
            $manager->persist($teamDirection);

            $teamRH = new Team();
            $teamRH->setName("Ressources Humaines");
            $manager->persist($teamRH);

            $teamDev = new Team();
            $teamDev->setName("Développement");
            $manager->persist($teamDev);

            $teamMarketing = new Team();
            $teamMarketing->setName("Marketing");
            $manager->persist($teamMarketing);
            $manager->flush();

            $userCompagny = [];

            for ($i = 1; $i <= 10; $i++) {
                $user = new User();
                $user->setUsername($faker->userName);
                $user->setEmail($faker->email);
                $user->setPhone($faker->phoneNumber);
                $user->setIsVerified(true);
                $user->setPassword($this->passwordEncoder->hashPassword($user, $faker->password));
                $user->setRoles(["ROLE_USER"]);
                $user->setCompagny($compagny);
                $manager->persist($user);
                $manager->flush();

                if ($i == 1) {
                    $teamDirection->addUser($user);
                }

                $channelGeneral->addMember($user);
                if ($i % 2 == 0) {
                    $channelRH->addMember($user);
                    $teamRH->addUser($user);
                }
                if ($i % 3 == 0) {
                    $channelMarketing->addMember($user);
                    $teamMarketing->addUser($user);
                }
                if ($i % 4 == 0) {
                    $channelDev->addMember($user);
                    $teamDev->addUser($user);
                }

                $userCompagny[] = $user;
            }

            $manager->flush();

            $competences = ["Rapidité", "Précision", "Rigueur", "Autonomie", "Sens de l'organisation", "Sens de la communication", "Sens de l'écoute", "Sens de l'analyse", "Sens de la synthèse", "Sens de l'initiative", "Sens de la négociation", "Sens de la persuasion"];

            foreach ($competences as $competence) {
                $uneTypeCompetence = $manager->getRepository(TypeCompetence::class)->findOneBy(['name' => $typeCompetence[array_rand($typeCompetence)]]);
                if ($uneTypeCompetence) {
                    $newCompetence = new Competence();
                    $newCompetence->setName($competence);
                    $newCompetence->setCompagny($compagny);
                    // on récupére une compétence aléatoire dans le tableau $typeCompetence
                    $newCompetence->setType($uneTypeCompetence);
                    $newCompetence->setCreatedAt($today);

                    $manager->persist($newCompetence);
                    $manager->flush();
                }
            }

            $tools = ["Word", "Excel", "PowerPoint", "Outlook", "Access", "Publisher", "Photoshop", "Illustrator", "InDesign", "Premiere Pro", "After Effects", "Lightroom", "Acrobat", "Dreamweaver", "Flash", "Sketch", "Figma", "InVision", "Zeplin", "Marvel", "Axure", "Balsamiq", "Adobe XD", "Framer", "Flinto", "Proto.io", "Principle", "Origami Studio", "UXPin", "Webflow", "Overflow", "Justinmind", "Mockplus", "Moqups", "MockFlow", "Fluid UI", "Cacoo", "UXPin", "Pidoco", "Adobe Comp", "UXPin", "Marvel", "InVision", "Origami Studio", "Figma", "Sketch", "Adobe XD", "Balsamiq", "Justinmind", "Axure", "Proto.io", "Mockplus", "Moqups", "MockFlow", "Fluid UI", "Cacoo", "UXPin", "Pidoco", "Adobe Comp"];

            foreach ($tools as $tool) {
                $newTool = new Tool();
                $newTool->setName($tool);
                $newTool->setCompagny($compagny);
                $newTool->setCreatedAt($today);

                $manager->persist($newTool);
                $manager->flush();
            }

            $sectors = ["Agriculture", "Agroalimentaire", "Architecture", "Artisanat", "Audiovisuel", "Automobile", "Banque", "Assurance", "Bâtiment", "Travaux publics", "Chimie", "Commerce", "Distribution", "Communication", "Comptabilité", "Gestion", "Administration", "Culture", "Défense", "Sécurité", "Droit", "Justice", "Edition", "Electronique", "Energie", "Enseignement", "Formation", "Environnement", "Entretien", "Nettoyage", "Fonction publique", "Hôtellerie", "Restauration", "Humanitaire", "Immobilier", "Logistique", "Transport", "Maintenance", "Entretien", "Marketing", "Publicité", "Mécanique", "Métallurgie", "Sidérurgie", "Numérique", "Informatique", "Recherche", "Santé", "Social", "Sciences", "Sport", "Animation", "Tourisme", "Loisirs", "Verre", "Bois", "Papier", "Textile", "Habillement", "Vente", "Commerce", "Autre"];

            foreach ($sectors as $sector) {
                $newSector = new Sector();
                $newSector->setName($sector);
                $newSector->setCompagny($compagny);

                $manager->persist($newSector);
                $manager->flush();
            }

            $criteres = array(
                "Compétences" => array(
                    "Compétences techniques spécifiques",
                    "Compétences linguistiques",
                    "Compétences en résolution de problèmes",
                    "Compétences interpersonnelles"
                ),
                "Expérience" => array(
                    "Années d'expérience dans le domaine",
                    "Expérience spécifique dans un secteur d'activité",
                    "Réalisations professionnelles antérieures",
                    "Expérience de travail en équipe"
                ),
                "Formation" => array(
                    "Diplômes universitaires",
                    "Certifications professionnelles",
                    "Formation continue",
                    "Cours pertinents pour le poste"
                ),
                "Personnalité" => array(
                    "Aptitudes à la communication",
                    "Capacité d'adaptation",
                    "Travail d'équipe",
                    "Résilience sous pression"
                ),
                "Motivation" => array(
                    "Enthousiasme pour l'industrie ou le domaine",
                    "Volonté d'apprendre et de se développer",
                    "Engagement envers les objectifs de l'entreprise",
                    "Passion pour le travail effectué"
                ),
                "Autre" => array(
                    "Disponibilité (horaire, déplacements, etc.)",
                    "Aptitudes en leadership",
                    "Projets personnels pertinents",
                    "Connaissances spécifiques du marché"
                )
            );

            foreach ($criteres as $key => $value) {
                foreach ($value as $critere) {
                    $typeCriteria = $manager->getRepository(TypeCriteria::class)->findOneBy(['name' => $key]);

                    if ($typeCriteria) {
                        $newCritere = new Criteria();
                        $newCritere->setName($critere);
                        // onrécupére le $typeCriteria qui a le nom $key
                        $newCritere->setType($typeCriteria);
                        $newCritere->setCompagny($compagny);
                        $newCritere->setCreatedAt($today);
                        $manager->persist($newCritere);
                        $manager->flush();
                    }
                }
            }
            $country = new Country();
            $country->setName("France");
            $manager->persist($country);
            $manager->flush();

            for ($i = 1; $i < 50; $i++) {
                $city = new City();
                $city->setName($faker->city);
                $city->setCountry($country);
                $manager->persist($city);
                $manager->flush();

                $address = new Address();
                $address->setStreet($faker->streetAddress);
                $address->setCity($city);
                $address->setPostalCode((int) $faker->postcode);
                $manager->persist($address);
                $manager->flush();

                $getPlatForm = $manager->getRepository(Platform::class)->findOneBy(['name' => $platForm[array_rand($platForm)]]);
                $getTypeStaff = $manager->getRepository(TypeStaff::class)->findOneBy(['name' => $typeStaff[array_rand($typeStaff)]]);
                if ($getPlatForm && $getTypeStaff) {
                    $staff = new Staff();
                    $staff->setFirstname($faker->firstName);
                    $staff->setLastname($faker->lastName);
                    $staff->setEmail($faker->email);
                    $staff->setPhone($faker->phoneNumber);
                    $staff->setCreatedAt($today);
                    $staff->setCompagny($compagny);
                    $staff->addAddress($address);
                    $staff->setType($getTypeStaff);
                    $staff->setPlatform($getPlatForm);
                    $staff->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                    for ($n = 1; $n < rand(1, 8); $n++) {
                        $getTool = $manager->getRepository(Tool::class)->findOneBy(['name' => $tools[array_rand($tools)]]);
                        if ($getTool) {
                            $staff->addTool($getTool);
                            $level = new Level();
                            $level->setStaff($staff);
                            $level->setTool($getTool);
                            $level->setType($manager->getRepository(TypeLevel::class)->findOneBy(['name' => $typeLevel[array_rand($typeLevel)]]));
                            $manager->persist($level);
                        }
                    }
                    for ($n = 1; $n < rand(1, 3); $n++) {
                        $getSector = $manager->getRepository(Sector::class)->findOneBy(['name' => $sectors[array_rand($sectors)]]);
                        if ($getSector) {
                            $staff->addSector($getSector);
                            $level = new Level();
                            $level->setStaff($staff);
                            $level->setSector($getSector);
                            $level->setType($manager->getRepository(TypeLevel::class)->findOneBy(['name' => $typeLevel[array_rand($typeLevel)]]));
                            $manager->persist($level);
                        }
                    }
                    for ($n = 1; $n < rand(1, 5); $n++) {
                        $getCriteres = $manager->getRepository(Criteria::class)->findOneBy(['name' => $criteres[array_rand($criteres)]]);
                        if ($getCriteres) {
                            $staff->addCriterium($getCriteres);
                            $level = new Level();
                            $level->setStaff($staff);
                            $level->setCriteria($getCriteres);
                            $level->setType($manager->getRepository(TypeLevel::class)->findOneBy(['name' => $typeLevel[array_rand($typeLevel)]]));
                            $manager->persist($level);
                        }
                    }
                     for ($n = 1; $n < rand(1, 5); $n++) {
                        $getCompetence = $manager->getRepository(Competence::class)->findOneBy(['name' => $competences[array_rand($competences)]]);
                        if ($getCompetence) {
                            $staff->addCompetence($getCompetence);
                            $level = new Level();
                            $level->setStaff($staff);
                            $level->setCompetence($getCompetence);
                            $level->setType($manager->getRepository(TypeLevel::class)->findOneBy(['name' => $typeLevel[array_rand($typeLevel)]]));
                            $manager->persist($level);
                        }
                    }
                    $manager->persist($staff);
                    $manager->flush();

                    for ($c = 1; $c < rand(1, 3); $c++) {
                        $comment = new Comment();
                        $comment->setContent($faker->text);
                        $comment->setCreatedAt($today);
                        $comment->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                        $manager->persist($comment);
                        $manager->flush();

                        $staff->addComment($comment);
                    }

                    for ($d = 1; $d < rand(1, 3); $d++) {
                        $document = new Document();
                        $document->setName($faker->sentence);
                        $document->setPath($faker->url);
                        $document->setCreatedAt($today);
                        $document->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                        $document->setType($manager->getRepository(TypeDocument::class)->findOneBy(['name' => $typeDocument[array_rand($typeDocument)]]));
                        $manager->persist($document);
                        $manager->flush();

                        $staff->addDocument($document);
                    }

                    $manager->persist($staff);
                    $manager->flush();


                    $event = new Event();
                    $event->setTitle($faker->sentence);
                    $event->setContent($faker->text);
                    $event->setCreatedAt($today);
                    $event->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                    $event->setCompagny($compagny);
                    $event->setPeriod(false);
                    $event->setAttached($staff);
                    $event->setDueDateAt($today);
                    $event->setPriority($manager->getRepository(Priority::class)->findOneBy(['name' => $priorities[array_rand($priorities)]]));
                    $event->setType($manager->getRepository(TypeEvent::class)->findOneBy(['name' => $typeEvent[array_rand($typeEvent)]]));
                    $event->setStatus($manager->getRepository(StatusEvent::class)->findOneBy(['name' => $status[array_rand($status)]]));

                    for ($n = 1; $n < rand(1, 5); $n++) {
                        $event->addAssigned($userCompagny[array_rand($userCompagny)]);
                    }

                    $manager->persist($event);
                    $manager->flush();

                    for ($c = 1; $c < rand(1, 6); $c++) {
                        $comment = new Comment();
                        $comment->setContent($faker->text);
                        $comment->setCreatedAt($today);
                        $comment->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                        $comment->setEvent($event);
                        $manager->persist($comment);
                        $manager->flush();
                    }

                    for ($d = 1; $d < rand(1, 3); $d++) {
                        $document = new Document();
                        $document->setName($faker->sentence);
                        $document->setPath($faker->url);
                        $document->setCreatedAt($today);
                        $document->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                        $document->setType($manager->getRepository(TypeDocument::class)->findOneBy(['name' => $typeDocument[array_rand($typeDocument)]]));
                        $document->setEvent($event);
                        $manager->persist($document);
                        $manager->flush();
                    }



                    for ($n = 1; $n < rand(1, 5); $n++) {
                        $step = new Step();
                        $step->setTitle($faker->sentence);
                        $step->setContent($faker->text);
                        $step->setCreatedAt($today);
                        $step->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                        $step->setStatus($manager->getRepository(StatusStep::class)->findOneBy(['name' => $status[array_rand($status)]]));
                        $step->setType($manager->getRepository(TypeStep::class)->findOneBy(['name' => $typeStep[array_rand($typeStep)]]));
                        $step->setEvent($event);
                        $manager->persist($step);
                        $manager->flush();


                        for ($c = 1; $c < rand(1, 3); $c++) {
                            $comment = new Comment();
                            $comment->setContent($faker->text);
                            $comment->setCreatedAt($today);
                            $comment->setCreatedBy($userCompagny[array_rand($userCompagny)]);
                            $comment->setStep($step);
                            $manager->persist($comment);
                            $manager->flush();

                        }
                    }
                }
            }
        }

        $manager->flush();
    }
}
