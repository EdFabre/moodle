<?php
require_once(dirname(__FILE__) . '/../../../config.php');
require_once("$CFG->dirroot/mod/mediasite/MediasiteClientFactory.php");
require_once("$CFG->dirroot/mod/mediasite/Presentation.php");
require_once("$CFG->dirroot/mod/mediasite/Catalog.php");
require_once("$CFG->dirroot/mod/mediasite/Exceptions.php");

function xmldb_mediasite_upgrade($oldversion=0) {
	
	global $CFG,$DB;
    $dbman = $DB->get_manager();
	
	$result = true;

    $module = new stdClass();
    include("$CFG->dirroot/mod/mediasite/version.php");

    // Upgrade
    if($result && $oldversion == 2012032900)
    {
        // Define table mediasite_status to be created.
        $table = new xmldb_table('mediasite_status');

        // Adding fields to table mediasite_status.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('sessionid', XMLDB_TYPE_CHAR, '20', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('processed', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('status', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table mediasite_sites.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for mediasite_sites.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Add the index
        $index = new xmldb_index('sessionid');
        $index->set_attributes(XMLDB_INDEX_UNIQUE, array('sessionid'));
        $dbman->add_index($table, $index);

        // Define table mediasite_sites to be created.
        $table = new xmldb_table('mediasite_sites');

        // Adding fields to table mediasite_sites.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('sitename', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, 'Default');
        $table->add_field('endpoint', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('apikey', XMLDB_TYPE_CHAR, '36', null, XMLDB_NOTNULL, null, null);
        $table->add_field('username', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, 'MediasiteAdmin');
        $table->add_field('password', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('passthru', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1');
        $table->add_field('siteclient', XMLDB_TYPE_CHAR, '16', null, XMLDB_NOTNULL, null, 'odata');
        $table->add_field('sslselect', XMLDB_TYPE_INTEGER, '1',   null, XMLDB_NOTNULL, null, '0');
        $table->add_field('cert',      XMLDB_TYPE_BINARY,  null,  null, null,          null, null);

        // Adding keys to table mediasite_sites.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('sitename', XMLDB_KEY_UNIQUE, array('sitename'));

        // Conditionally launch create table for mediasite_sites.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table mediasite_sites to be created.
        $table = new xmldb_table('mediasite_config');

        // Adding fields to table mediasite_sites.
        $table = new xmldb_table('mediasite_config');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('siteid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('openaspopup', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1');
        $table->add_field('duration', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '300');
        $table->add_field('restrictip', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table mediasite_sites.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('siteid', XMLDB_KEY_UNIQUE, array('siteid'));

        // Conditionally launch create table for mediasite_sites.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        $key = new xmldb_key('defaultsiteidforeignkey', XMLDB_KEY_FOREIGN, array('siteid'), 'mediasite_sites', array('id'));
        // Launch add key defaultsiteidforeignkey.
        $dbman->add_key($table, $key);

        // Define field siteid to be added to mediasite.
        $table = new xmldb_table('mediasite');
        $field = new xmldb_field('siteid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        // Conditionally launch add field siteid.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('description', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        // Conditionally launch add field intro.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('duration', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '300');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('restrictip', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $key = new xmldb_key('siteidforeignkey', XMLDB_KEY_FOREIGN, array('siteid'), 'mediasite_sites', array('id'));
        // Launch add key siteidforeignkey.
        $dbman->add_key($table, $key);
		
		// At this point we have the new table and have updated the
		//old table with the new field.
        $default_record = array();
		$site_record = array();
		$site_record['sitename'] = 'Default';
		$site_record['passthru'] = '0';
		$whereclause = 'name LIKE \'mediasite%\'';

		$config_records = $DB->get_records_sql("SELECT * FROM {config} WHERE $whereclause");
		foreach($config_records as $config_record) {
			if($config_record->name == 'mediasite_username') {
				$site_record['username'] = $config_record->value;
			} elseif($config_record->name == 'mediasite_password') {
				$site_record['password'] = $config_record->value;
			} elseif($config_record->name == 'mediasite_serverurl') {
                $site_record['endpoint'] = preg_replace('/6_1_7\/?$/', 'main', $config_record->value);
			} elseif($config_record->name == 'mediasite_ticketduration') {
                $default_record['duration'] = $config_record->value;
			} elseif($config_record->name == 'mediasite_restricttoip') {
                $default_record['restrictip'] = $config_record->value;
            } elseif($config_record->name == 'mediasite_openaspopup') {
                $default_record['openaspopup'] = $config_record->value;
			}
		}

        if(!array_key_exists("endpoint", $site_record) ||
           !array_key_exists("username", $site_record) ||
           !array_key_exists("password", $site_record)) {
            return false;
        }
        $client = Sonicfoundry\MediasiteClientFactory::MediasiteClient('odata',$site_record['endpoint'], $site_record['username'], $site_record['password'], null);

        $siteproperties = $client->QuerySiteProperties();
        if(!preg_match('/7\.\d+\.\d+/', $siteproperties->SiteVersion)) {
            return false;
        }
        // Try to get the apiKey
        try {
            if(!($apiKey = $client->GetApiKeyById())) {
                if(!($apiKey = $client->CreateApiKey())) {
                    return false;
                }
            }
            $site_record['apikey'] = $apiKey->Id;
        } catch(\Sonicfoundry\SonicfoundryException $se) {
            if(!($apiKey = $client->CreateApiKey())) {
                return false;
            }
            $site_record['apikey'] = $apiKey->Id;
        } catch(Exception $e) {
            if(!($apiKey = $client->CreateApiKey())) {
                return false;
            }
            $site_record['apikey'] = $apiKey->Id;
        }

        // Now we are modifying the database records

        $DB->delete_records_select('config', $whereclause);
        $site_id = $DB->insert_record('mediasite_sites', $site_record, true);

        $default_record['siteid'] = $site_id;
        $DB->insert_record('mediasite_config', $default_record, true);

        $mediasite_rs = $DB->get_recordset('mediasite');
        if($mediasite_rs->valid()){
            foreach ($mediasite_rs as $mediasite_record) {
                $record = new stdClass();
                $record->id = $mediasite_record->id;
                if($mediasite_record->resourcetype == get_string('presentation', 'mediasite')) {
                    $presentation = $client->QueryPresentationById($mediasite_record->resourceid);
                    $record->description = $presentation->Description;
                } elseif($mediasite_record->resourcetype == get_string('catalog', 'mediasite')) {
                    $catalog = $client->QueryCatalogById($mediasite_record->resourceid);
                    $record->description = $catalog->Description;
                }
                $record->siteid = $site_id;
                if(isset($default_record['openaspopup'])) {
                    $record->openaspopup = $default_record['openaspopup'];
                }
                if(isset($default_record['duration'])) {
                    $record->duration = $default_record['duration'];
                }
                if(isset($default_record['restrictip'])) {
                    $record->restrictip = $default_record['restrictip'];
                }
                $DB->update_record('mediasite', $record, true);
                //Be aware that from Moodle 2.6 onwards modinfo + sectioncache have been
                //removed from the mdl_course table - they are now stored in the Moodle cache.
                //This means that the only safe way to clear them is via
                rebuild_course_cache($mediasite_record->course, true);
            }
        }
        //$DB->execute('UPDATE {course} set modinfo = ?, sectiocache = ?', array(null, null));
        $mediasite_rs->close();

        $table = new xmldb_table('mediasite');
        $field = new xmldb_field('description', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, null);
        $dbman->change_field_notnull($table, $field);

        upgrade_mod_savepoint(true, $module->version, 'mediasite');
    }
    //if($result && $oldversion < 2014031001)
    //{
    //    $table = new xmldb_table('mediasite_sites');
    //    $field = new xmldb_field('siteclient', XMLDB_TYPE_CHAR, '16', null, XMLDB_NOTNULL, null, 'odata');
    //    if (!$dbman->field_exists($table, $field)) {
    //        $dbman->add_field($table, $field);
    //    }

    //    upgrade_mod_savepoint(true, 2014031001, 'mediasite');
    //}


    return $result;
}

?>
