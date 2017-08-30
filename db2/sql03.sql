-- 1) Crie uma função em PL/pgSQL chamada de atualizar_qtde_alunos que some quantidade de alunos e atualize a coluna qtdeAlunos da Tabela Turma; 

CREATE OR REPLACE FUNCTION atualizar_qtde_alunos()
 RETURNS VOID AS
$$
DECLARE
	r_alunosPorTurma RECORD;
BEGIN
	-- Seleciona a quantidade de alunos por turma
	FOR r_alunosPorTurma IN
    	(SELECT T.TURMA_ID, COUNT(1) total_alunos
        	FROM TURMA T,
         		MATRICULA M
         WHERE M.TURMA_ID = T.TURMA_ID 
        GROUP BY T.TURMA_ID) LOOP
        
        -- Atualiza a quantidade de alunos por cada turma resultante
        UPDATE TURMA
        SET quantidade_alunos = r_alunosPorTurma.total_alunos
        WHERE turma_id = r_alunosPorTurma.turma_id;       
        END LOOP;
END
$$
LANGUAGE 'plpgsql';

SELECT atualizar_qtde_alunos();
SELECT * FROM TURMA;