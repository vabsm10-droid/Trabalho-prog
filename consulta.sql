USE loja_eletronica;
SELECT 
    p.id_peca,
    p.nome AS peca,
    p.preco,
    p.quantidade,
    f.nome AS fornecedor,
    f.cidade
FROM pecas p
JOIN fornecedores f
ON p.id_fornecedor = f.id_fornecedor;
