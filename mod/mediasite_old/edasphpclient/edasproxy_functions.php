<?php

    /**
     * @internal
     *
     * Proxy classes for Mediasite External Data Access Service (Edas)
     * These proxy classes were generated based on the Mediasite 6.0 EDAS WSDL definition.
     * PHP Version 5.3
     *
     * @copyright  Copyright (c) 2013, Sonic Foundry
     * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
     * @version    6.1.7
     * @package    SonicFoundry.Mediasite.Edas.PHPProxy
     * @subpackage Functions
     * @author     Cori Schlegel <coris@sonicfoundry.com>
     *             This software is provided "AS IS" without a warranty of any kind.
     * @since      6.1.1
     */
    class TypeMapFunctions
    {
        /*  Namespaces from Mediasite WSDL */
        static $tns = "http://www.SonicFoundry.com/Mediasite/Services60/Messages";
        static $q5 = "http://schemas.microsoft.com/2003/10/Serialization/Arrays";
        static $i = "http://www.w3.org/2001/XMLSchema-instance";
        /**
         * @internal dateTime[]
         *
         */
        static function hoistDatesWatchedList( $list ) {
            return self::hoistArrayOfType($list, 'dateTime');
        }
        /**
         * @internal IdNameTotalPair[]
         *
         */
        static function hoistArrayOfIdNameTotalPair( $array ) {
            return self::hoistArrayOfType($array, 'IdNameTotalPair');
        }
        /**
         * @internal PresentationUsage[]
         *
         */
        static function hoistArrayOfPresentationUsage( $array ) {
            return self::hoistArrayOfType($array, 'PresentationUsage');
        }
        /**
         * @internal ActiveConnection[]
         *
         */
        static function hoistArrayOfActiveConnection( $array ) {
            return self::hoistArrayOfType($array, 'ActiveConnection');
        }
        /**
         * @internal FolderDetails[]
         *
         */
        static function hoistArrayOfFolderDetails( $array ) {
            return self::hoistArrayOfType($array, 'FolderDetails');
        }
        /**
         * @internal PresentationContentDetails[]
         *
         */
        static function hoistArrayOfPresentationContentDetails( $list ) {
             return self::hoistArrayOfType($list, 'PresentationContentDetails');
        }
        /**
         * @internal PresentationDetails[]
         *
         */
        static function hoistArrayOfPresentationDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'PresentationDetails');
        }
        /**
         * @internal UserProfileMapping[]
         *
         */
        static function hoistArrayOfUserProfileMappings( $obj ) {
            return self::hoistArrayOfType($obj, 'UserProfileMapping');
        }
        /**
         * @internal Id[]
         *
         */
        static function hoistCreateMediasiteKeyValueResponseId( $obj ) {
            return self::hoistType($obj, "Id");
        }
        /**
         * @internal PresentationTemplateDetails[]
         *
         */
        static function hoistArrayOfPresentationTemplateDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'PresentationTemplateDetails');
        }
        /**
         * @internal string[]
         *
         */
        static function hoistArrayOfString( $obj ) {
            return self::hoistArrayOfType($obj, 'string', self::$q5);
        }
        /**
         * @internal MediasiteKeyValue[]
         *
         */
        static function hoistArrayOfMediasiteKeyValue( $obj ) {
            return self::hoistArrayOfType($obj, 'MediasiteKeyValue');
        }
        /**
         * @internal ContentEncodingSettingDetails[]
         *
         */
        static function hoistArrayOfContentEncodingSettingDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'ContentEncodingSettingDetails');
        }
        /**
         * @internal MediasiteTimeZone[]
         *
         */
        static function hoistArrayOfMediasiteTimeZone( $obj ) {
            return self::hoistArrayOfType($obj, 'MediasiteTimeZone');
        }
        /**
         * @internal ScheduleDetails[]
         *
         */
        static function hoistArrayOfScheduleDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'ScheduleDetails');
        }
        /**
         * @internal ScheduleRecurrenceDetails[]
         *
         */
        static function hoistArrayOfScheduleRecurrenceDetails( $obj ) {
            print( "hoisting ArrayOfScheduleRecurrenceDetails\n" );

            return self::hoistArrayOfType($obj, 'ScheduleRecurrenceDetails');
        }
        /**
         * @internal CatalogShare[]
         *
         */
        static function hoistArrayOfCatalogShare( $obj ) {
            return self::hoistArrayOfType($obj, 'CatalogShare');
        }
        /**
         * @internal RecurrenceList[]
         *
         */
        static function hoistScheduleRecurrenceDetails( $obj ) {
            return self::hoistType($obj, 'RecurrenceList');
        }
        /**
         * @internal MediasiteRoleDetails[]
         *
         */
        static function hoistArrayOfMediasiteRoleDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'MediasiteRoleDetails');
        }
        /**
         * @internal ChapterDetails[]
         *
         */
        static function hoistArrayOfChapterDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'ChapterDetails');
        }
        /**
         * @internal PresenterDetails[]
         *
         */
        static function hoistArrayOfPresenterDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'PresenterDetails');
        }
        /**
         * @internal ContentServerDetails[]
         *
         */
        static function hoistArrayOfContentServerDetails( $obj ) {
            //TODO: to hoist content server endpoints to the ServerConnection level, I'm going to have to manhandle some
            //    xml here and add them back to the Content Server.
            $contentServers = self::hoistArrayOfType($obj, 'ContentServerDetails');

            return $contentServers;
        }
        /**
         * @internal ContentServerEndpoint[]
         *
         */
        static function hoistArrayOfContentServerEndpoint( $obj ) {
            return self::hoistArrayOfType($obj, 'ContentServerEndpoint');
        }
        /**
         * @internal PlayerDetails[]
         *
         */
        static function hoistArrayOfPlayerDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'PlayerDetails');
        }
        /**
         * @internal ResourcePermissionEntry[]
         *
         */
        static function hoistArrayOfResourcePermissionEntry( $obj ) {
            return self::hoistArrayOfType($obj, 'ResourcePermissionEntry');
        }
        /**
         * @internal ResourcePermissions[]
         *
         */
        static function hoistArrayOfResourcePermissions( $obj ) {
            return self::hoistArrayOfType($obj, 'ResourcePermissions');
        }
        /**
         * @internal SlideDetails[]
         *
         */
        static function hoistArrayOfSlideDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'SlideDetails');
        }
        /**
         * @internal ArrayOfPresentationTemplateDetails[]
         *
         */
        static function hoistArrayOfArrayOfPresentationTemplateDetails( $obj ) {
            return self::hoistArrayOfType($obj, 'ArrayOfPresentationTemplateDetails');
        }
        /**
         * @internal ResourceRegistrationCustomFieldDefinition[]
         *
         */
        static function hoistArrayOfResourceRegistrationCustomFieldDefinition($array)
        {
            return self::hoistArrayOfType($array, 'ResourceRegistrationCustomFieldDefinition');
        }
        /**
         * @internal ResourceRegistrationDetail[]
         *
         */
        static function hoistArrayOfResourceRegistrationDetail($array)
        {
            return self::hoistArrayOfType($array, 'ResourceRegistrationDetail');
        }
        /**
         * @internal ResourceRegistrationCustomField[]
         *
         */
        static function hoistArrayOfResourceRegistrationCustomField($array)
        {
            return self::hoistArrayOfType($array, 'ResourceRegistrationCustomField');
        }
        /**
         * @internal ImportProjectItemProgress[]
         *
         */
        static function hoistArrayOfImportProjectItemProgress($array)
        {
            return self::hoistArrayOfType($array, 'ImportProjectItemProgress');
        }
        /**
         * @internal SegmentViews[]
         *
         */
         static function hoistArrayOfSegmentViews( $array )
		 {
             return self::hoistArrayOfType($array, 'SegmentViews');
         }
        /**
         * @internal ViewingSession[]
         *
         */
         static function hoistArrayOfViewingSession( $array )
		 {
             return self::hoistArrayOfType($array, 'ViewingSession');
         }
        /**
         * @internal
         *
         * Hoists objects out of Arrayof* types into php arrays
         *
         * @param      $obj
         * @param      $innerType
         * @param null $ns
         *
         * @return array
         */
        protected static function hoistArrayOfType( $obj, $innerType, $ns = null ) {
            if ( is_null($ns) ) {
                $ns = self::$tns;
            }

            $sxe      = simplexml_load_string($obj, null, LIBXML_NOBLANKS | LIBXML_NOENT, $ns);
            $ar       = Array();
            $xmlArray = $sxe->children($ns);
            foreach ( $xmlArray->$innerType as $key => $val ) {

                //  remove nodes where the nil attribute is true; otherwise they end up in the output as empty stdClass objects
                $nodesToUnset = array();
                foreach ( $val as $name => $el ) {
                    $iatts = $el->attributes(self::$i);
                    if ( $iatts['nil'] ) {
                        array_push($nodesToUnset, $name);
                    }
                }
                foreach ( $nodesToUnset as $node ) {
                    unset( $val->$node );
                }

                if ( $innerType == 'string' ) {
                    $ar[] = (string)$val;
                } else {
                    $ar[] = self::objectToObject($val, $innerType);
                }
            }

            return $ar;
        }

        /**
         * @internal
         *
         * @param      $obj
         * @param      $innerType
         * @param null $ns
         *
         * @return mixed
         */
        protected static function hoistType( $obj, $innerType, $ns = null ) {
            if ( is_null($ns) ) {
                $ns = self::$tns;
            }
            $sxe = simplexml_load_string($obj);
            $xml = $sxe->children($ns);

            return self::objectify($xml);
        }

        /**
         * @internal
         *
         * @param $val
         *
         * @return mixed
         */
        protected static function objectify( $val ) {
            return json_decode(json_encode($val));
        }

        /**
         * @internal
         *
         * Translates a stdClass Object to the specified type
         *
         * @param $instance
         * @param $className
         *
         * @return mixed
         */
        static function objectToObject( $instance, $className ) {
            $newInstance = ( json_decode(json_encode($instance)) );

            return unserialize(sprintf(
                'O:%d:"%s"%s',
                strlen($className),
                $className,
                strstr(strstr(serialize($newInstance), '"'), ':')
            ));
        }

    }