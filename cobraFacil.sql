create table grupo(
    id int not null auto_increment,
    id_empresa int not null,
    nome varchar(100),
    primary key (id)
);

create table cliente(
    id int not null auto_increment,
    id_empresa int not null,
    bloqueado tinyint(1) default 0,
    nome varchar(100) not null,
    cpf varchar(15) not null,
    rg varchar(30) not null,
    dt_nasc date,
    sexo tinyint(1) not null,
logadouro
                numero
                complemento
    uf varchar(2) not null,
    cidade varchar(35) not null,
    cep varchar(9),
    telefone varchar(20) not null,
    email varchar(50) not null,
    senha text not null,
    contrato int,
    grupo int,
    observacoes text,
    primary key (id)
);

create table log(
    id int not null auto_increment,
    data datetime not null,
    user varchar(50),
    id_empresa int not null,
    texto text not null,
    primary key (id)
);

/* Tabela na base de dados AnguloWeb */
create table transacao(
    id int not null auto_increment,
    id_empresa int not null,
    id_sistema int,
    id_boleto int not null,
    id_cliente int not null,
    valor float not null,
    dt_vencimento date not null,
    multa float not null,
    juro float not null,
    dt_pagamento date,
    valor_pago float,

    primary key (id),
    foreign key (id_boleto) references boleto (id)
);

create table boleto(
    id int not null auto_increment,
    id_empresa int not null,
    titulo varchar(100) not null,
    banco tinyint not null,
    prazo_pagamento tinyint default 0,
    taxa_boleto float default 0,

    instrucoes1 text,
    instrucoes2 text,
    instrucoes3 text,
    instrucoes4 text,

    agencia varchar(11) not null,
    conta varchar(11) not null,
    conta_dv varchar(4) not null,
    convenio varchar(15) not null,
    
    identificacao varchar(100) not null,
    cpf_cnpj varchar(15) not null,
    endereco varchar(300),
    cidade varchar(35) not null,
    uf varchar(2) not null,

    primary key (id)
);
