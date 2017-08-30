-- 4.1) Listar os dados dos alunos;
CREATE MATERIALIZED VIEW dados_alunos AS
SELECT * FROM Aluno

SELECT * FROM dados_alunos;

-- 4.2) Listar os dados dos alunos e as turmas que eles estão matriculados;
CREATE MATERIALIZED VIEW dados_alunos_matriculados AS
SELECT a.*, t.turma_id FROM Aluno a, Matricula m, Turma t
WHERE a.aluno_id = m.aluno_id AND m.turma_id = t.turma_id;

SELECT * FROM dados_alunos_matriculados;

-- 4.3) Listar os alunos que não possuem faltas;
CREATE MATERIALIZED VIEW dados_alunos_sem_falta AS
SELECT alu.* FROM Aluno alu, Matricula m, Ausencia aus
WHERE alu.aluno_id = m.aluno_id AND m.matricula_id = aus.matricula_id;

SELECT * FROM dados_alunos_sem_falta;

-- 4.4) Listar os professores e a quantidade de turmas que cada um leciona;
CREATE MATERIALIZED VIEW professores_qnt_turmas AS
SELECT p.*, 
     ( SELECT COUNT(1)
          FROM Turma t
      WHERE p.professor_id = t.professor_id ) as total_turmas
FROM Professor p;	

SELECT * FROM professores_qnt_turmas;

-- 4.5) Listar nome dos professores, apenas um dos números de telefone do professor,
-- dados (id da turma, data início, data fim e horário) das turmas que o professor leciona,
-- curso da turma e alunos matriculados ordenado por nome do professor, id turma e nome do aluno; 
CREATE MATERIALIZED VIEW historico_professores AS
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

SELECT * FROM historico_professores;

-- 4.6) Listar os nomes dos professores e a turma que cada um leciona com maior número de alunos;
CREATE MATERIALIZED VIEW professores_maiores_turmas AS
SELECT p.nome, tt.turma_id, tt.total_alunos
	FROM Professor p INNER JOIN LATERAL
    	(SELECT t.turma_id, COUNT(1) as total_alunos
         	FROM Matricula m, Turma t
         	WHERE T.professor_id = p.professor_id
         	AND m.turma_id = t.turma_id
         GROUP BY 1
         ORDER BY 2 DESC
         LIMIT 1 ) tt ON TRUE
        
SELECT * FROM professores_maiores_turmas
-- 4.7) Listar os nomes dos alunos ordenados pela turma que estes possuem maior número de faltas. Deve aparecer apenas a turma que cada um dos alunos tem maior quantidade de faltas;

-- 4.8) Listar a quantidade média de alunos por curso.
-- 5) Fazer alterações nas tabelas:
-- 5.1) Alterar o nome de todos os professores para maiúsculo;
-- 5.2) Colocar o nome de todos os alunos que estão na turma com o maior número de alunos em maiúsculo;
-- 6) Excluir as ausências dos alunos nas turmas que estes são monitores;