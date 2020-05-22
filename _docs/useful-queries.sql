

UPDATE stspapacss0520_options SET option_value = replace(option_value, 'http://papeiseacessorios.com.br', 'http://papeiseacessorios.dev.br/') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE stspapacss0520_posts SET guid = replace(guid, 'http://papeiseacessorios.com.br','http://papeiseacessorios.dev.br/');
UPDATE stspapacss0520_posts SET post_content = replace(post_content, 'http://papeiseacessorios.com.br', 'http://papeiseacessorios.dev.br/');
UPDATE stspapacss0520_postmeta SET meta_value = replace(meta_value,'http://papeiseacessorios.com.br','http://papeiseacessorios.dev.br/');

-- Veja se ha mais dados com a URL desatualizada - CUIDADO COM DADOS SERIALIZADOS!
SELECT * FROM stspapacss0520_options WHERE option_value LIKE '%http://papeiseacessorios.com.br%';



-- Show table indexes
SHOW INDEX FROM stspapacss0520_options;

-- Show tables size in MB
SELECT table_name, ROUND(((data_length + index_length) / 1024 / 1024), 2) AS "Size (MB)"
FROM information_schema.TABLES
-- WHERE table_name = "stspapacss0520_options"
ORDER BY (data_length + index_length) DESC;

-- Show tables size in KiB
SELECT ROUND(SUM(LENGTH(option_value))/ 1024) as 'autoload_size in KiB' FROM stspapacss0520_options WHERE autoload = 'yes';

-- If 60-80% of the option_name keys are autoload = no values then an index is a good idea
SELECT COUNT(1) as total, COUNT(CASE WHEN autoload = 'yes' THEN 1 END) as yes, COUNT(CASE WHEN autoload = 'no' THEN 1 END) as no FROM stspapacss0520_options;
SHOW INDEX FROM stspapacss0520_options;
-- CREATE INDEX autoloadindex ON stspapacss0520_options(autoload, option_name);

-- Removing revisions
SELECT * FROM stspapacss0520_posts WHERE post_type = "revision";
-- DELETE FROM stspapacss0520_posts WHERE post_type = "revision";


