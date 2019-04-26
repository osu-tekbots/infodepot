--
-- Database initialization SQL for the InfoDepot site
--
-- This SQL assumes that the `user` table has already been created
--

CREATE TABLE IF NOT EXISTS info_depot_course (
    idcr_id INT NOT NULL AUTO_INCREMENT,
    idcr_name VARCHAR(128) NOT NULL,
    idcr_code VARCHAR(16) NOT NULL,

    PRIMARY KEY (idcr_id)
);

CREATE TABLE IF NOT EXISTS info_depot_item (
    idi_id CHAR(16) NOT NULL,
    idi_u_id CHAR(16) NOT NULL,
    idi_title VARCHAR(256) NOT NULL,
    idi_details TEXT NOT NULL,
    idi_idcr_id INT NOT NULL,
    idi_date_created DATETIME NOT NULL,
    idi_date_updated DATETIME,

    PRIMARY KEY (idi_id),
    FOREIGN KEY (idi_u_id) REFERENCES user (u_id),
    FOREIGN KEY (idi_idcr_id) REFERENCES info_depot_course (idcr_id)
);

CREATE TABLE IF NOT EXISTS info_depot_item_artifact (
    idia_id CHAR(16) NOT NULL,
    idia_idi_id CHAR(16) NOT NULL,
    idia_description TEXT,
    idia_file VARCHAR(256),
    idia_mime VARCHAR(32),
    idia_link VARCHAR(512),

    PRIMARY KEY (idia_id),
    FOREIGN KEY (idia_idi_id) REFERENCES info_depot_item (idi_id)
);

CREATE TABLE IF NOT EXISTS info_depot_comment (
    idc_id CHAR(16) NOT NULL,
    idc_u_id CHAR(16) NOT NULL,
    idc_idi_id CHAR(16) NOT NULL,
    idc_content TEXT NOT NULL,
    idc_recommended BOOLEAN,
    idc_date_created DATETIME NOT NULL,
    idc_date_updated DATETIME,

    PRIMARY KEY (idc_id),
    FOREIGN KEY (idc_u_id) REFERENCES user (u_id),
    FOREIGN KEY (idc_idi_id) REFERENCES info_depot_item (idi_id)
);

CREATE TABLE IF NOT EXISTS info_depot_rating (
    idr_u_id CHAR(16) NOT NULL,
    idr_idi_id CHAR(16) NOT NULL,
	idr_value TEXT NOT NULL,

    PRIMARY KEY (idr_u_id, idr_idi_id),
    FOREIGN KEY (idr_u_id) REFERENCES user (u_id),
    FOREIGN KEY (idr_idi_id) REFERENCES info_depot_item (idi_id)
);