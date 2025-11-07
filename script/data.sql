insert into adresse (num, libelle, cp, ville) values 
    ( 25, 'rue du terte', '66100', 'Perpignan' ),
    ( 10, 'rue du soleil', '66000', 'Perpignan' ),
    ( 90, 'ave. Julien Panchot', '66100', 'Perpignan' ),
    ( 4, 'rue des cigales', '66240', 'Saint-Estève' ),
    ( 36, 'rue du stade', '66240', 'Saint-Estève' ),
    ( 25, 'rue éole', '66100', 'Perpignan' );

insert into client (nom, prenom, email, tel, adresse_id) values
    ('Dupont', 'Alice', 'alice.dupont@example.com', '0601020304', 1),
    ('Martin', 'Julien', 'julien.martin@example.com', '0611223344', 2),
    ('Bernard', 'Sophie', 'sophie.bernard@example.com', '0677889900', 3),
    ('Durand', 'Lucas', 'lucas.durand@example.com', '0644556677', 4),
    ('Petit', 'Emma', 'emma.petit@example.com', '0699001122', 5),
    ('Roux', 'Nicolas', 'nicolas.roux@example.com', '0633557799', 6),
    ('Moreau', 'Camille', 'camille.moreau@example.com', '0622446688', 2),
    ('Fournier', 'Thomas', 'thomas.fournier@example.com', '0655778899', 3),
    ('Girard', 'Laura', 'laura.girard@example.com', '0611993355', 1),
    ('Mercier', 'Hugo', 'hugo.mercier@example.com', '0688112233', 4);