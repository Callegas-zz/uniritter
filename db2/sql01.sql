CREATE SEQUENCE tipo_curso_tipo_curso_id_seq_1;

CREATE TABLE Tipo_Curso (
                tipo_curso_id BIGINT NOT NULL DEFAULT nextval('tipo_curso_tipo_curso_id_seq_1'),
                nome VARCHAR(200) NOT NULL,
                CONSTRAINT tipo_curso_pk PRIMARY KEY (tipo_curso_id)
);


ALTER SEQUENCE tipo_curso_tipo_curso_id_seq_1 OWNED BY Tipo_Curso.tipo_curso_id;

CREATE SEQUENCE aluno_aluno_id_seq;

CREATE TABLE Aluno (
                aluno_id BIGINT NOT NULL DEFAULT nextval('aluno_aluno_id_seq'),
                altura_cm NUMERIC NOT NULL,
                peso_kg NUMERIC NOT NULL,
                data_nascimento DATE NOT NULL,
                numero VARCHAR(11) NOT NULL,
                codigo_matricula VARCHAR NOT NULL,
                data_matricula DATE NOT NULL,
                nome VARCHAR(100) NOT NULL,
                endereco VARCHAR(300) NOT NULL,
                CONSTRAINT aluno_pk PRIMARY KEY (aluno_id)
);


ALTER SEQUENCE aluno_aluno_id_seq OWNED BY Aluno.aluno_id;

CREATE UNIQUE INDEX aluno_idx
 ON Aluno
 ( codigo_matricula );

CREATE SEQUENCE professor_professor_id_seq_1;

CREATE TABLE Professor (
                professor_id BIGINT NOT NULL DEFAULT nextval('professor_professor_id_seq_1'),
                titulacao VARCHAR(100) NOT NULL,
                data_nascimento DATE NOT NULL,
                nome VARCHAR(100) NOT NULL,
                cpf VARCHAR(11) NOT NULL,
                CONSTRAINT professor_pk PRIMARY KEY (professor_id)
);


ALTER SEQUENCE professor_professor_id_seq_1 OWNED BY Professor.professor_id;

CREATE SEQUENCE telefone_professor_telefone_id_seq;

CREATE TABLE Telefone_Professor (
                telefone_id BIGINT NOT NULL DEFAULT nextval('telefone_professor_telefone_id_seq'),
                professor_id BIGINT NOT NULL,
                numero VARCHAR(50) NOT NULL,
                CONSTRAINT telefone_professor_pk PRIMARY KEY (telefone_id)
);


ALTER SEQUENCE telefone_professor_telefone_id_seq OWNED BY Telefone_Professor.telefone_id;

CREATE SEQUENCE turma_turma_id_seq;

CREATE TABLE Turma (
                turma_id BIGINT NOT NULL DEFAULT nextval('turma_turma_id_seq'),
                aluno_monitor_id BIGINT,
                tipo_curso_id BIGINT NOT NULL,
                professor_id BIGINT NOT NULL,
                data_final DATE NOT NULL,
                quantidade_alunos INTEGER NOT NULL,
                horario_aula TIME NOT NULL,
                duracao_aula_horas NUMERIC NOT NULL,
                data_inicial DATE NOT NULL,
                CONSTRAINT turma_pk PRIMARY KEY (turma_id)
);


ALTER SEQUENCE turma_turma_id_seq OWNED BY Turma.turma_id;

CREATE SEQUENCE matricula_matricula_id_seq;

CREATE TABLE Matricula (
                matricula_id BIGINT NOT NULL DEFAULT nextval('matricula_matricula_id_seq'),
                aluno_id BIGINT NOT NULL,
                turma_id BIGINT NOT NULL,
                CONSTRAINT matricula_pk PRIMARY KEY (matricula_id)
);


ALTER SEQUENCE matricula_matricula_id_seq OWNED BY Matricula.matricula_id;

CREATE UNIQUE INDEX matricula_idx
 ON Matricula
 ( aluno_id, turma_id );

CREATE SEQUENCE ausencia_ausencia_id_seq;

CREATE TABLE Ausencia (
                ausencia_id BIGINT NOT NULL DEFAULT nextval('ausencia_ausencia_id_seq'),
                matricula_id BIGINT NOT NULL,
                daTA DATE NOT NULL,
                CONSTRAINT ausencia_pk PRIMARY KEY (ausencia_id)
);


ALTER SEQUENCE ausencia_ausencia_id_seq OWNED BY Ausencia.ausencia_id;

ALTER TABLE Turma ADD CONSTRAINT tipo_curso_turma_fk
FOREIGN KEY (tipo_curso_id)
REFERENCES Tipo_Curso (tipo_curso_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE Matricula ADD CONSTRAINT aluno_matricula_fk
FOREIGN KEY (aluno_id)
REFERENCES Aluno (aluno_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE Turma ADD CONSTRAINT aluno_turma_fk
FOREIGN KEY (aluno_monitor_id)
REFERENCES Aluno (aluno_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE Turma ADD CONSTRAINT professor_turma_fk
FOREIGN KEY (professor_id)
REFERENCES Professor (professor_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE Telefone_Professor ADD CONSTRAINT professor_telefone_fk
FOREIGN KEY (professor_id)
REFERENCES Professor (professor_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE Matricula ADD CONSTRAINT turma_matricula_fk
FOREIGN KEY (turma_id)
REFERENCES Turma (turma_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE Ausencia ADD CONSTRAINT matricula_ausencia_fk
FOREIGN KEY (matricula_id)
REFERENCES Matricula (matricula_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;


INSERT INTO Tipo_curso
	(nome)
VALUES
	('Analise'),
    ('Direito'),
    ('Engenharia');
    
INSERT INTO Aluno
	(nome, altura_cm, peso_kg, data_nascimento, numero, codigo_matricula,
     data_matricula, endereco)
VALUES
	('Fellipe', 174, 88, '1992-12-12', '51985737770', 'alu01', '2017-02-25', 'Rua a'),
    ('Pedro', 178, 50, '1993-01-20', '51989887825', 'alu02', '2016-02-18', 'Rua b'),
    ('Matheus', 178, 70, '1990-06-06', '51899889985', 'alu03', '2016-06-12', 'Rua c');
    
INSERT INTO Professor
	(nome, cpf, titulacao, data_nascimento)
VALUES
	('Joana', '0235678502', 'Mestre', '1980-08-12'),
    ('Juliano', '012212545', 'Doutor', '1975-05-12'),
    ('Mariana', '545478751', 'Doutor', '1985-02-10');

INSERT INTO Turma
	(tipo_curso_id, aluno_monitor_id, professor_id, data_inicial, data_final, quantidade_alunos, horario_aula, duracao_aula_horas)
VALUES
	(1, null, 1, '2017-02-20', '2017-06-20', 30, '18:20', 4),
    (1, 1, 2, '2017-02-20', '2017-06-20', 20, '19:20', 4),
    (3, 3, 3, '2017-03-15', '2017-05-20', 40, '20:00', 3);
    
INSERT INTO Telefone_Professor
	(professor_id, numero)
VALUES
	(1, '5199999999'),
    (1, '5188888888'),
    (2, '5177777777');

INSERT INTO Matricula
	(aluno_id, turma_id)
VALUES
	(1, 1),
    (2, 1),
    (2, 3);
    
INSERT INTO Ausencia
	(matricula_id, data)
VALUES
	(1, '2017-03-20'),
    (1, '2017-03-21'),
    (2, '2017-02-20');

-- 4.1) Listar os dados dos alunos;
SELECT * FROM Aluno

-- 4.2) Listar os dados dos alunos e as turmas que eles estão matriculados;
SELECT a.*, t.turma_id FROM Aluno a, Matricula m, Turma t
WHERE a.aluno_id = m.aluno_id AND m.turma_id = t.turma_id;

-- 4.3) Listar os alunos que não possuem faltas;
SELECT alu.* FROM Aluno alu, Matricula m, Ausencia aus
WHERE alu.aluno_id = m.aluno_id AND m.matricula_id = aus.matricula_id;

-- 4.4) Listar os professores e a quantidade de turmas que cada um leciona;
SELECT p.*, 
     ( SELECT COUNT(1)
          FROM Turma t
      WHERE p.professor_id = t.professor_id ) as total_turmas
FROM Professor p;	

-- 4.5) Listar nome dos professores, apenas um dos números de telefone do professor,
-- dados (id da turma, data início, data fim e horário) das turmas que o professor leciona,
-- curso da turma e alunos matriculados ordenado por nome do professor, id turma e nome do aluno; 
SELECT p.nome,
	(SELECT t.numero
     	FROM Telefone_Professor t
     WHERE t.professor_id = p.professor_id
     LIMIT 1 ) AS telefone,
     t.turma_id, t.data_inicial, t.data_final, t.horario_aula,
     tc.nome as nome_curso
     FROM Professor p INNER JOIN Turma t
    		ON (t.professor_id = p.professor_id )
        INNER JOIN Tipo_Curso tc
      		ON ( tc.tipo_curso_id = t.tipo_curso_id)
        INNER JOIN Matricula m
         	ON (m.turma_id = t.turma_id)
        INNER JOIN Aluno a
        	ON (a.aluno_id = m.aluno_id )
        ORDER BY 1, t.turma_id, a.nome;

-- 4.6) Listar os nomes dos professores e a turma que cada um leciona com maior número de alunos;
SELECT p.nome, tt.turma_id, tt.total_alunos
	FROM Professor p INNER JOIN LATERAL
    	(SELECT t.turma_id, COUNT(1) as total_alunos
         	FROM Matricula m, Turma t
         	WHERE T.professor_id = p.professor_id
         	AND m.turma_id = t.turma_id
         GROUP BY 1
         ORDER BY 2 DESC
         LIMIT 1 ) tt ON TRUE
-- 4.7) Listar os nomes dos alunos ordenados pela turma que estes possuem maior número de faltas. Deve aparecer apenas a turma que cada um dos alunos tem maior quantidade de faltas;

-- 4.8) Listar a quantidade média de alunos por curso.
-- 5) Fazer alterações nas tabelas:
-- 5.1) Alterar o nome de todos os professores para maiúsculo;
-- 5.2) Colocar o nome de todos os alunos que estão na turma com o maior número de alunos em maiúsculo;
-- 6) Excluir as ausências dos alunos nas turmas que estes são monitores;