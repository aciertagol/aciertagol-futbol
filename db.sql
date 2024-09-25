-- Insertar usuarios
INSERT INTO
    usuarios (username, password, rol)
VALUES (
        'admin',
        '$2y$10$x6fOtze3kCGCpMJiHOhb5OHSmH2M.3xTdqmii995ROMMaesh0k9Bm',
        'admin'
    ), -- Reemplaza con un hash real
    (
        'user1',
        '$2y$10$examplehashedpassword',
        'usuario'
    );

-- Insertar equipos
INSERT INTO
    equipos (nombre, escudo)
VALUES (
        'Equipo A',
        'images/equipo_a.png'
    ),
    (
        'Equipo B',
        'images/equipo_b.png'
    ),
    (
        'Equipo C',
        'images/equipo_c.png'
    );

-- Insertar partidos
INSERT INTO
    partidos (
        equipo_local,
        equipo_visitante,
        fecha,
        hora
    )
VALUES (
        1,
        2,
        '2024-09-21',
        '18:00:00'
    ),
    (
        2,
        3,
        '2024-09-22',
        '16:00:00'
    );

-- Insertar estadísticas
INSERT INTO
    estadisticas (
        partido_id,
        goles_local,
        goles_visitante
    )
VALUES (1, 3, 2), -- Partido ID 1
    (2, 1, 1);
-- Partido ID 2
-- Insertar patrocinadores
INSERT INTO
    patrocinadores (nombre, logo)
VALUES (
        'Patrocinador 1',
        'images/patrocinador1.png'
    ),
    (
        'Patrocinador 2',
        'images/patrocinador2.png'
    );

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) NOT NULL
);

-- Tabla de equipos
CREATE TABLE equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    escudo VARCHAR(255) NOT NULL
);

-- Tabla de partidos
CREATE TABLE partidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo_local INT,
    equipo_visitante INT,
    fecha DATETIME NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (equipo_local) REFERENCES equipos (id),
    FOREIGN KEY (equipo_visitante) REFERENCES equipos (id)
);

-- Tabla de estadísticas
CREATE TABLE estadisticas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partido_id INT,
    goles_local INT DEFAULT 0,
    goles_visitante INT DEFAULT 0,
    FOREIGN KEY (partido_id) REFERENCES partidos (id)
);

-- Tabla de patrocinadores
CREATE TABLE patrocinadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    logo VARCHAR(255) NOT NULL
);