# $Id$
CREATE TABLE packages (
       id             INTEGER NOT NULL,
       name           VARCHAR(80) NOT NULL,
       package_type   ENUM('pear','pecl') NOT NULL default 'pear',
       category       INTEGER, -- REFERENCES categories(id),
       stablerelease  VARCHAR(20),
       develrelease   VARCHAR(20),
       license        VARCHAR(20),
       summary	      TEXT,
       description    TEXT,
       homepage       VARCHAR(255),
       doc_link       VARCHAR(255),
       cvs_link       VARCHAR(255),
       approved       TINYINT(4) NOT NULL default '0',
       PRIMARY KEY(id),
       UNIQUE INDEX(name),
       INDEX(category)
);
