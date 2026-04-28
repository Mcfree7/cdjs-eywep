<?php

return [

    // ── Navigation ──────────────────────────────────────────────────────────
    'nav' => [
        'home'         => 'Accueil',
        'publications' => 'Publications',
        'articles'     => 'Articles',
        'activities'   => 'Activités',
        'testimonials' => 'Success Stories',
        'resources'    => 'Ressources',
        'galleries'    => 'Galeries',
        'projects'     => 'Projets',
        'about'        => 'À propos',
        'contact'      => 'Contact',
        'login'        => 'Connexion',
    ],

    // ── Recherche ────────────────────────────────────────────────────────────
    'search' => [
        'label'       => 'Rechercher',
        'placeholder' => 'Articles, projets, activités…',
        'aria'        => 'Rechercher',
        'close'       => 'Fermer la recherche',
        'submit'      => 'Lancer la recherche',
    ],

    // ── Footer ───────────────────────────────────────────────────────────────
    'footer' => [
        'navigation'   => 'Navigation',
        'contact'      => 'Contact',
        'useful_links' => 'Liens utiles',
        'location'     => 'Voir la localisation',
        'copyright'    => 'Tous droits réservés.',
    ],

    // ── Bannières de page ─────────────────────────────────────────────────
    'pages' => [
        'home'         => 'Accueil',
        'articles'     => 'Articles',
        'activities'   => 'Activités',
        'testimonials' => 'Success Stories',
        'galleries'    => 'Galeries',
        'resources'    => 'Ressources',
        'projects'     => 'Projets',
        'about'        => 'À propos',
        'contact'      => 'Contactez-nous',
        'search'       => 'Résultats de recherche',
    ],

    // ── Balises <title> ───────────────────────────────────────────────────
    'titles' => [
        'home'         => 'Accueil',
        'articles'     => 'Articles',
        'activities'   => 'Activités',
        'testimonials' => 'Success Stories',
        'galleries'    => 'Galeries',
        'resources'    => 'Ressources',
        'projects'     => 'Projets',
        'about'        => 'À propos',
        'contact'      => 'Contact',
        'search'       => 'Recherche',
        'login'        => 'Connexion',
    ],

    // ── Boutons / CTA communs ─────────────────────────────────────────────
    'btn' => [
        'read_more'    => 'Lire la suite',
        'see_all'      => 'Voir tout',
        'see_project'  => 'Voir le projet',
        'apply'        => 'Candidater',
        'download'     => 'Télécharger',
        'back'         => 'Retour',
        'send'         => 'Envoyer',
        'contact_us'   => 'Nous contacter',
        'ask_question' => 'Poser votre question',
        'back_home'    => 'Retour à l\'accueil',
    ],

    // ── Langue ───────────────────────────────────────────────────────────
    'lang' => [
        'fr' => 'Français',
        'pt' => 'Português',
        'en' => 'English',
    ],

    // ── Messages flash ────────────────────────────────────────────────────
    'flash' => [
        'success' => 'Succès !',
        'error'   => 'Erreur !',
    ],

    // ── Page À propos ─────────────────────────────────────────────────────
    'about' => [
        'section_label' => 'À propos',
        'title'         => 'À propos de :name',
        'lead'          => 'EYWEP est une initiative conjointe de la CEDEAO et d\'AUDA-NEPAD visant à promouvoir l\'autonomisation économique des jeunes et des femmes entrepreneurs en Afrique de l\'Ouest.',
        'body'          => 'Mis en œuvre par le Centre de Développement de la Jeunesse et des Sports de la CEDEAO, le programme crée un environnement favorable à l\'entrepreneuriat en mettant l\'accent sur le renforcement des capacités, l\'accès au financement, l\'accompagnement technique et la promotion d\'entreprises innovantes et durables dans les États membres. Une phase pilote est menée dans six pays : Bénin, Ghana, Côte d\'Ivoire, Sénégal, Guinée Bissau et Gambie.',
        'bullets' => [
            'Formation en gestion d\'entreprise et renforcement des capacités des jeunes entrepreneurs.',
            'Accès au financement et services d\'appui aux PME dirigées par des jeunes et des femmes.',
            'Mentorat, accompagnement technique et partage des meilleures pratiques entrepreneuriales.',
            'Promotion de la création d\'emplois et de l\'inclusion économique dans l\'espace CEDEAO.',
        ],
        'stats' => [
            ['label' => 'Pays pilotes',           'target' => 6,   'suffix' => ''],
            ['label' => 'États membres CEDEAO',   'target' => 15,  'suffix' => ''],
            ['label' => 'Jeunes entrepreneurs',   'target' => 500, 'suffix' => '+'],
            ['label' => 'PME soutenues',          'target' => 200, 'suffix' => '+'],
        ],
        'mvv_label'  => 'Ce qui nous guide',
        'mvv_title'  => 'Mission, Vision & Valeurs',
        'mvv' => [
            [
                'title' => 'Notre Mission',
                'text'  => 'Renforcer durablement les capacités des jeunes entrepreneurs en leur offrant formations, accompagnement technique, accès au financement et services de soutien adaptés pour favoriser la création et la pérennisation de leurs entreprises.',
                'icon'  => '<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
            ],
            [
                'title' => 'Notre Vision',
                'text'  => 'Bâtir un écosystème dynamique où les jeunes entrepreneurs, hommes et femmes, sont pleinement autonomes, innovants et prospères, contribuant à la création d\'emplois et au développement économique durable dans l\'espace CEDEAO.',
                'icon'  => '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/><path d="M12 1V3M12 21V23M4.22 4.22L5.64 5.64M18.36 18.36L19.78 19.78M1 12H3M21 12H23M4.22 19.78L5.64 18.36M18.36 5.64L19.78 4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
            ],
            [
                'title' => 'Nos Valeurs',
                'text'  => 'Inclusion, innovation, durabilité et partenariat stratégique guident chacune de nos actions pour réduire les inégalités de genre et favoriser la transformation économique durable de l\'Afrique de l\'Ouest.',
                'icon'  => '<path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
            ],
        ],
        'partners_label' => 'Nos partenaires',
        'faq_label'      => 'Questions',
        'faq_title'      => 'Des questions ? Voici quelques réponses',
        'faq_subtitle'   => 'Vous souhaitez en savoir plus sur le programme EYWEP, les conditions de participation ou les activités proposées ? Retrouvez ci-dessous les questions les plus fréquentes.',
        'faq_empty'      => 'Aucune question disponible pour le moment.',
    ],

    // ── Formulaire de candidature ─────────────────────────────────────────
    'apply' => [
        'breadcrumb'         => 'Projets',
        'success_msg'        => 'Votre candidature a bien été envoyée. Un e-mail de confirmation vous a été transmis.',
        'closed_msg'         => 'Les candidatures pour ce projet sont fermées.',
        'info_title'         => 'Informations du projet',
        'status_label'       => 'Statut',
        'status_open'        => 'Ouvert',
        'status_closed'      => 'Fermé',
        'status_archived'    => 'Archivé',
        'published_label'    => 'Date de publication',
        'published_prefix'   => 'Publié le',
        'deadline_label'     => 'Date de clôture',
        'deadline_expired'   => 'Expiré',
        'applications_label' => 'Candidatures reçues',
        'download_tdr'       => 'Télécharger les TDR',
        'photos_title'       => 'Photos du projet',
        'view_image'         => 'Voir l\'image en taille réelle',
        'closed_banner_title'=> 'Candidatures fermées',
        'closed_expired'     => 'La date limite du :date est dépassée.',
        'closed_no_more'     => 'Ce projet n\'accepte plus de candidatures.',
        'form_title'         => 'Postuler à ce projet',
        'form_subtitle'      => 'Remplissez le formulaire ci-dessous pour soumettre votre candidature.',
        'label_nom'          => 'Nom',
        'label_prenom'       => 'Prénom',
        'label_pays'         => 'Pays',
        'label_sexe'         => 'Sexe',
        'label_email'        => 'Adresse e-mail',
        'label_telephone'    => 'Numéro de téléphone',
        'label_motivation'   => 'Lettre de motivation',
        'label_motivation_hint' => '(PDF, max 5 Mo)',
        'label_identite'     => 'Pièce d\'identité',
        'label_identite_hint'   => '(PDF, max 5 Mo)',
        'label_cv'           => 'CV',
        'label_cv_hint'      => '(PDF, DOC ou DOCX, max 5 Mo)',
        'placeholder_nom'    => 'Votre nom',
        'placeholder_prenom' => 'Votre prénom',
        'select_default'     => '-- Sélectionner --',
        'sexe_homme'         => 'Homme',
        'sexe_femme'         => 'Femme',
        'sexe_autre'         => 'Autre',
        'submit'             => 'Envoyer ma candidature',
        'close_alert'        => 'Fermer',

        'section_docs'       => 'Documents complémentaires',
        'section_docs_hint'  => 'Ces documents sont facultatifs mais renforcent votre dossier de candidature.',
        'label_pdf_hint'     => '(PDF, max 10 Mo)',
        'tooltip_aria'       => 'En savoir plus',

        'label_business_plan'    => 'Business plan simplifié',
        'tooltip_business_plan'  => '<strong>Présentation de l\'idée ou de l\'entreprise</strong><br>• Problème identifié et solution proposée<br>• Marché cible et clients<br>• Modèle économique<br>• Objectifs à court et moyen terme<br>• Impact attendu (économique, social, etc.)',

        'label_plan_financier'   => 'Plan financier prévisionnel',
        'tooltip_plan_financier' => '• Budget estimatif (coûts de démarrage ou d\'expansion)<br>• Besoins de financement<br>• Sources de financement envisagées',

        'label_documents_legaux'   => 'Documents légaux de l\'entreprise (si existante)',
        'tooltip_documents_legaux' => '• Registre de commerce ou équivalent<br>• Statuts de l\'entreprise<br>• Numéro d\'identification fiscale',

        'label_autres_activites'   => 'Autres activités / Preuves d\'activité',
        'tooltip_autres_activites' => '• Photos des produits ou services<br>• Lien vers site web ou réseaux sociaux<br>• Témoignages clients ou partenaires',
    ],

    // ── Page Contact ──────────────────────────────────────────────────────
    'contact' => [
        'section_label'   => 'Contactez-nous',
        'heading'         => 'Contactez-nous',
        'address_label'   => 'Notre adresse',
        'phone_label'     => 'Téléphone',
        'email_label'     => 'Email',
        'follow_label'    => 'Suivez-nous',
        'form_title'      => 'Envoyez-nous un message',
        'form_subtitle'   => 'Nous vous répondons dans les plus brefs délais.',
        'placeholder_name'    => 'Votre Nom *',
        'placeholder_email'   => 'Votre Email *',
        'placeholder_subject' => 'Sujet *',
        'placeholder_message' => 'Votre message *',
        'label_name'      => 'Votre Nom',
        'label_email'     => 'Email',
        'label_subject'   => 'Sujet',
        'label_message'   => 'Votre message',
        'send_btn'        => 'Envoyer le message',
        'map_title'       => 'Localisation EYWEP',
    ],

    // ── Projets (index) ───────────────────────────────────────────────────
    'projects' => [
        'no_projects'   => 'Aucun projet disponible pour le moment.',
        'status_open'   => 'Ouvert',
        'status_closed' => 'Fermé',
        'status_arch'   => 'Archivé',
        'apply_success' => 'Votre candidature a bien été soumise. Un email de confirmation vous a été envoyé.',
    ],

    // ── Page d'accueil ────────────────────────────────────────────────────
    'home' => [
        'flash_info'         => 'Flash Info',
        'hero_projects'      => 'Nos Projets',
        'hero_video_badge'   => 'Présentation',
        'hero_video_label'   => 'Voir la vidéo',
        'about_subheading'   => 'À propos du programme',
        'about_title'        => 'Le Programme EYWEP',
        'learn_more'         => 'En savoir plus',
        'partners_label'     => 'Nos Partenaires',
        'articles_label'     => 'Actualités',
        'articles_title'     => 'Derniers Articles',
        'see_all_articles'   => 'Voir tous les articles',
        'activities_label'   => 'Activités',
        'activities_title'   => 'Nos Dernières Activités',
        'activity_badge'     => 'Activité',
        'see_all_activities' => 'Voir toutes les activités',
        'projects_title'     => 'Nos Derniers Projets',
        'candidature_one'    => 'candidature',
        'candidature_many'   => 'candidatures',
        'see_all_projects'   => 'Voir tous les projets',
        'stories_label'      => 'Success Stories',
        'stories_title'      => 'Success Stories',
        'story_badge'        => 'Success Story',
        'see_all_stories'    => 'Voir toutes les Success Stories',
        'galleries_label'    => 'Galeries',
        'galleries_title'    => 'Nos Galeries Photos',
        'see_gallery'        => 'Voir la galerie',
        'media_one'          => 'média',
        'media_many'         => 'médias',
        'see_all_galleries'  => 'Voir toutes les galeries',
        'faq_more'           => 'En Savoir plus',
    ],
];
