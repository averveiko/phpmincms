/**
 * Author:  averveyko
 * Created: May 8, 2017
 */

CREATE TABLE pages(
	name CHAR(50) PRIMARY KEY NOT NULL,
	title CHAR(50),
	content TEXT
);

INSERT INTO pages (name, title, content)
VALUES ('index', 'index title', '<h1>Index page</h1>');

INSERT INTO pages (name, title, content)
VALUES ('about', 'about title', '<h1>About page</h1>');

CREATE TABLE links(
	href CHAR(50) PRIMARY KEY NOT NULL,
	text CHAR(50)
);

INSERT INTO links (href, text)
VALUES ('index.php', 'Index page');

INSERT INTO links (href, text)
VALUES ('index.php?p=about', 'About page');