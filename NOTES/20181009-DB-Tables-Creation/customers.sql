CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `customers_id` int(50) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
    `brand_name` varchar (100) default NULL,
    `branch` varchar (100) default NULL,
    `activity` varchar (100) default NULL,
    `name` varchar (100) default NULL,
    `lastname` varchar (100) default NULL,
    `AFM` int (100) default NULL,
    `DOY` varchar (100) default NULL,
    `address` varchar (100) default NULL,
    `TK` int (50) default NULL,
    `phone` int (100) default NULL,
    `mobilephone` int (100) default NULL,
    `fax` int (100) default NULL,
    `email` varchar (100) default NULL,
    `url` varchar (100) default NULL,
  PRIMARY KEY  (`customers_id`),
  KEY `lastname` (`lastname`),
  KEY `AFM` (`AFM`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS tbl_extinguisher_heads (
`extinguisher_heads_id` int(50) NOT NULL auto_increment,
    `ext_head_brandname` varchar(100),
    PRIMARY KEY  (`extinguisher_heads_id`),
    KEY `ext_head_brandname` (`ext_head_brandname`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS tbl_manufacturers_fext (
`manufacturers_fext_id` int(50) NOT NULL auto_increment,
    `manufacturers_fext_brandname` varchar(100),
    PRIMARY KEY  (`manufacturers_fext_id`),
    KEY `ext_head_brandname` (`manufacturers_fext_brandname`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `tbl_periodic_inspection` (
  `periodic_inspection_id` int(50) NOT NULL auto_increment,
    `customers_id` int (50) default NULL,
    `fext_type` varchar (100) default NULL,
    `serialnumber` varchar (100) default NULL,
    `maintenance_type` varchar (100) default NULL,
    `notes` varchar (100) default NULL,
    `useless` tinyint (5) default NULL,
    `date_useless` date NOT NULL default '0000-00-00',
    `date_add_check` date NOT NULL default '0000-00-00',
    `date_next_check` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`periodic_inspection_id`),
  KEY `date_useless` (`date_useless`),
  KEY `date_add_check` (`date_add_check`),
  KEY `date_next_check` (`date_next_check`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS tbl_fire_extinguisher (
    `fire_extinguisher_id` int(50) NOT NULL auto_increment,
    `customers_id` int (50) default NULL,
    `fext_type_id` int (50) default NULL,
    `manufacturers_fext_id` int(50) default NULL,
    `serialnumber` varchar (100) default NULL,
    `year` int (100) default NULL,
    `installation_date`date NOT NULL default '0000-00-00',
    `notes` varchar (100) default NULL,
    PRIMARY KEY  (`fire_extinguisher_id`),
    KEY `installation_date` (`installation_date`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS tbl_fext_type (
    `fext_type_id` int(50) NOT NULL auto_increment,
    `fext_type` varchar(100),
    PRIMARY KEY  (`fext_type_id`),
    KEY `fext_type` (`fext_type`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;











