<?php
	/**
	 * Sept 14, 2021 - wpg
	 * - added JoCoOAT4AlphaGal because these samples were previously labeled under another AlphaGal
	 * 
	 * The StudyType class defined here contains
	 * code for the StudyType enumerated type.  It represents
	 * the enumerated values found in the "study_type" table
	 * in the database.
	 * 
	 * To use, you should use the StudyType subclass which
	 * extends this StudyTypeGen class.
	 * 
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the StudyType class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 */
	abstract class StudyTypeGen extends QBaseClass {
		const JoCoOAT0 = 1;
		const JoCoOAT1 = 2;
		const JoCoOAT1s = 3;
		const JoCoOAT2 = 4;
		const BuddyGo = 5;
		const GOGO = 6;
		const GOGOLong = 7;
		const JoCoOAT3 = 8;
		const SerumMusculoskeletalTissueBank = 9;
		const PTOAbaselineUNCsamples = 10;
		const PTOAbaselineTOAsamples = 11;
		const PTOA6monthUNCsamples = 12;
		const PTOA12monthUNCsamples = 13;
		const PTOA6monthTOAsamples = 14;
		const PTOA12monthTOAsamples = 15;
		const JoCoOAT4 = 16;
		const AGCohort1131057295dp = 17;
		const Microbiome2017 = 18;
		const JoCoHSE03 = 19;
		const AlphaGalE03 = 20;
		const JoCoOAT4AlphaGal = 22;

		const MaxId = 22;

		public static $NameArray = array(
			1 => 'JoCoOA T0',
			2 => 'JoCoOA T1',
			3 => 'JoCoOA T1s',
			4 => 'JoCoOA T2',
			5 => 'Buddy/Go',
			6 => 'GOGO',
			7 => 'GOGO Long',
			8 => 'JoCoOA T3',
			9 => 'Serum & Musculoskeletal Tissue Bank',
			10 => 'PT-OA baseline (UNC samples)',
			11 => 'PT-OA baseline (TOA samples)',
			12 => 'PT-OA 6 month (UNC samples)',
			13 => 'PT-OA 12 month (UNC samples)',
			14 => 'PT-OA 6 month (TOA samples)',
			15 => 'PT-OA 12 month (TOA samples)',
			16 => 'JoCoOA T4',
			17 => 'AG Cohort 1/13-1057 (#295-dp)',
			18 => 'Microbiome 2017',
			19 => 'JoCoHS E03',
			20 => 'AlphaGal E03',
			22 => 'JoCoOA T4 AlphaGal');

		public static $TokenArray = array(
			1 => 'JoCoOAT0',
			2 => 'JoCoOAT1',
			3 => 'JoCoOAT1s',
			4 => 'JoCoOAT2',
			5 => 'BuddyGo',
			6 => 'GOGO',
			7 => 'GOGOLong',
			8 => 'JoCoOAT3',
			9 => 'SerumMusculoskeletalTissueBank',
			10 => 'PTOAbaselineUNCsamples',
			11 => 'PTOAbaselineTOAsamples',
			12 => 'PTOA6monthUNCsamples',
			13 => 'PTOA12monthUNCsamples',
			14 => 'PTOA6monthTOAsamples',
			15 => 'PTOA12monthTOAsamples',
			16 => 'JoCoOAT4',
			17 => 'AGCohort1131057295dp',
			18 => 'Microbiome2017',
			19 => 'JoCoHSE03',
			20 => 'AlphaGalE03',
			22 => 'JoCoOAT4AlphaGal');

		public static function ToString($intStudyTypeId) {
			switch ($intStudyTypeId) {
				case 1: return 'JoCoOA T0';
				case 2: return 'JoCoOA T1';
				case 3: return 'JoCoOA T1s';
				case 4: return 'JoCoOA T2';
				case 5: return 'Buddy/Go';
				case 6: return 'GOGO';
				case 7: return 'GOGO Long';
				case 8: return 'JoCoOA T3';
				case 9: return 'Serum & Musculoskeletal Tissue Bank';
				case 10: return 'PT-OA baseline (UNC samples)';
				case 11: return 'PT-OA baseline (TOA samples)';
				case 12: return 'PT-OA 6 month (UNC samples)';
				case 13: return 'PT-OA 12 month (UNC samples)';
				case 14: return 'PT-OA 6 month (TOA samples)';
				case 15: return 'PT-OA 12 month (TOA samples)';
				case 16: return 'JoCoOA T4';
				case 17: return 'AG Cohort 1/13-1057 (#295-dp)';
				case 18: return 'Microbiome 2017';
				case 19: return 'JoCoHS E03';
				case 20: return 'AlphaGal E03';
				case 22: return 'JoCoOA T4 AlphaGal';
				default:
					throw new QCallerException(sprintf('Invalid intStudyTypeId: %s', $intStudyTypeId));
			}
		}

		public static function ToToken($intStudyTypeId) {
			switch ($intStudyTypeId) {
				case 1: return 'JoCoOAT0';
				case 2: return 'JoCoOAT1';
				case 3: return 'JoCoOAT1s';
				case 4: return 'JoCoOAT2';
				case 5: return 'BuddyGo';
				case 6: return 'GOGO';
				case 7: return 'GOGOLong';
				case 8: return 'JoCoOAT3';
				case 9: return 'SerumMusculoskeletalTissueBank';
				case 10: return 'PTOAbaselineUNCsamples';
				case 11: return 'PTOAbaselineTOAsamples';
				case 12: return 'PTOA6monthUNCsamples';
				case 13: return 'PTOA12monthUNCsamples';
				case 14: return 'PTOA6monthTOAsamples';
				case 15: return 'PTOA12monthTOAsamples';
				case 16: return 'JoCoOAT4';
				case 17: return 'AGCohort1131057295dp';
				case 18: return 'Microbiome2017';
				case 19: return 'JoCoHSE03';
				case 20: return 'AlphaGalE03';
				case 22: return 'JoCoOAT4AlphaGal';
				default:
					throw new QCallerException(sprintf('Invalid intStudyTypeId: %s', $intStudyTypeId));
			}
		}
	}
?>