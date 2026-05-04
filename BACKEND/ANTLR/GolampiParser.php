<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.13.2
 */

namespace {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiParser extends Parser
	{
		public const T__0 = 1, T__1 = 2, T__2 = 3, T__3 = 4, T__4 = 5, T__5 = 6, 
               T__6 = 7, T__7 = 8, T__8 = 9, T__9 = 10, T__10 = 11, T__11 = 12, 
               T__12 = 13, T__13 = 14, T__14 = 15, T__15 = 16, T__16 = 17, 
               T__17 = 18, T__18 = 19, T__19 = 20, T__20 = 21, T__21 = 22, 
               T__22 = 23, T__23 = 24, T__24 = 25, T__25 = 26, T__26 = 27, 
               T__27 = 28, T__28 = 29, T__29 = 30, T__30 = 31, T__31 = 32, 
               T__32 = 33, T__33 = 34, T__34 = 35, T__35 = 36, T__36 = 37, 
               T__37 = 38, T__38 = 39, T__39 = 40, T__40 = 41, T__41 = 42, 
               T__42 = 43, T__43 = 44, T__44 = 45, T__45 = 46, T__46 = 47, 
               T__47 = 48, T__48 = 49, T__49 = 50, T__50 = 51, T__51 = 52, 
               T__52 = 53, T__53 = 54, T__54 = 55, T__55 = 56, T__56 = 57, 
               T__57 = 58, T__58 = 59, T__59 = 60, ID = 61, INT = 62, FLOAT = 63, 
               STRING = 64, RUNE = 65, LINE_COMMENT = 66, BLOCK_COMMENT = 67, 
               WS = 68;

		public const RULE_program = 0, RULE_declaration = 1, RULE_varDecl = 2, 
               RULE_constDecl = 3, RULE_functionDecl = 4, RULE_parameters = 5, 
               RULE_parameter = 6, RULE_pointer = 7, RULE_returnType = 8, 
               RULE_typeList = 9, RULE_type = 10, RULE_primitiveType = 11, 
               RULE_arrayType = 12, RULE_statement = 13, RULE_block = 14, 
               RULE_shortVarDecl = 15, RULE_assignment = 16, RULE_assignOp = 17, 
               RULE_exprStmt = 18, RULE_ifStmt = 19, RULE_switchStmt = 20, 
               RULE_caseClause = 21, RULE_defaultClause = 22, RULE_forStmt = 23, 
               RULE_forClause = 24, RULE_forInit = 25, RULE_breakStmt = 26, 
               RULE_continueStmt = 27, RULE_returnStmt = 28, RULE_expression = 29, 
               RULE_logicalOr = 30, RULE_logicalAnd = 31, RULE_equality = 32, 
               RULE_relational = 33, RULE_additive = 34, RULE_multiplicative = 35, 
               RULE_unary = 36, RULE_postfix = 37, RULE_incrementOp = 38, 
               RULE_index = 39, RULE_call = 40, RULE_primary = 41, RULE_arrayLiteral = 42, 
               RULE_arrayElements = 43, RULE_arrayElement = 44, RULE_builtinCall = 45, 
               RULE_exprList = 46, RULE_idList = 47, RULE_literal = 48;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'declaration', 'varDecl', 'constDecl', 'functionDecl', 'parameters', 
			'parameter', 'pointer', 'returnType', 'typeList', 'type', 'primitiveType', 
			'arrayType', 'statement', 'block', 'shortVarDecl', 'assignment', 'assignOp', 
			'exprStmt', 'ifStmt', 'switchStmt', 'caseClause', 'defaultClause', 'forStmt', 
			'forClause', 'forInit', 'breakStmt', 'continueStmt', 'returnStmt', 'expression', 
			'logicalOr', 'logicalAnd', 'equality', 'relational', 'additive', 'multiplicative', 
			'unary', 'postfix', 'incrementOp', 'index', 'call', 'primary', 'arrayLiteral', 
			'arrayElements', 'arrayElement', 'builtinCall', 'exprList', 'idList', 
			'literal'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'var'", "'='", "'const'", "'func'", "'('", "')'", "','", "'*'", 
		    "'int32'", "'float32'", "'bool'", "'rune'", "'string'", "'['", "']'", 
		    "'{'", "'}'", "':='", "'+='", "'-='", "'*='", "'/='", "'if'", "'else'", 
		    "'switch'", "'case'", "':'", "'default'", "'for'", "';'", "'break'", 
		    "'continue'", "'return'", "'?'", "'||'", "'&&'", "'=='", "'!='", "'>'", 
		    "'>='", "'<'", "'<='", "'+'", "'-'", "'/'", "'%'", "'!'", "'&'", "'++'", 
		    "'--'", "'fmt'", "'.'", "'Println'", "'len'", "'now'", "'substr'", 
		    "'typeOf'", "'true'", "'false'", "'nil'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, "ID", "INT", "FLOAT", "STRING", 
		    "RUNE", "LINE_COMMENT", "BLOCK_COMMENT", "WS"
		];

		private const SERIALIZED_ATN =
			[4, 1, 68, 466, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 2, 35, 7, 35, 2, 36, 7, 36, 2, 37, 7, 37, 2, 38, 
		    7, 38, 2, 39, 7, 39, 2, 40, 7, 40, 2, 41, 7, 41, 2, 42, 7, 42, 2, 
		    43, 7, 43, 2, 44, 7, 44, 2, 45, 7, 45, 2, 46, 7, 46, 2, 47, 7, 47, 
		    2, 48, 7, 48, 1, 0, 5, 0, 100, 8, 0, 10, 0, 12, 0, 103, 9, 0, 1, 0, 
		    1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 111, 8, 1, 1, 2, 1, 2, 1, 2, 1, 
		    2, 1, 2, 1, 2, 3, 2, 119, 8, 2, 3, 2, 121, 8, 2, 1, 3, 1, 3, 1, 3, 
		    1, 3, 1, 3, 1, 3, 1, 4, 1, 4, 1, 4, 1, 4, 3, 4, 133, 8, 4, 1, 4, 1, 
		    4, 3, 4, 137, 8, 4, 1, 4, 1, 4, 1, 5, 1, 5, 1, 5, 5, 5, 144, 8, 5, 
		    10, 5, 12, 5, 147, 9, 5, 1, 6, 1, 6, 3, 6, 151, 8, 6, 1, 6, 1, 6, 
		    1, 7, 1, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 162, 8, 8, 1, 9, 1, 
		    9, 1, 9, 5, 9, 167, 8, 9, 10, 9, 12, 9, 170, 9, 9, 1, 10, 1, 10, 3, 
		    10, 174, 8, 10, 1, 11, 1, 11, 1, 12, 1, 12, 1, 12, 1, 12, 1, 12, 1, 
		    13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 
		    1, 13, 1, 13, 3, 13, 195, 8, 13, 1, 14, 1, 14, 5, 14, 199, 8, 14, 
		    10, 14, 12, 14, 202, 9, 14, 1, 14, 1, 14, 1, 15, 1, 15, 1, 15, 1, 
		    15, 1, 16, 1, 16, 1, 16, 1, 16, 1, 17, 1, 17, 1, 18, 1, 18, 1, 19, 
		    1, 19, 1, 19, 1, 19, 1, 19, 1, 19, 3, 19, 224, 8, 19, 3, 19, 226, 
		    8, 19, 1, 20, 1, 20, 1, 20, 1, 20, 5, 20, 232, 8, 20, 10, 20, 12, 
		    20, 235, 9, 20, 1, 20, 3, 20, 238, 8, 20, 1, 20, 1, 20, 1, 21, 1, 
		    21, 1, 21, 1, 21, 5, 21, 246, 8, 21, 10, 21, 12, 21, 249, 9, 21, 1, 
		    22, 1, 22, 1, 22, 5, 22, 254, 8, 22, 10, 22, 12, 22, 257, 9, 22, 1, 
		    23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 
		    3, 23, 269, 8, 23, 1, 24, 3, 24, 272, 8, 24, 1, 24, 1, 24, 3, 24, 
		    276, 8, 24, 1, 24, 1, 24, 3, 24, 280, 8, 24, 1, 25, 1, 25, 3, 25, 
		    284, 8, 25, 1, 26, 1, 26, 1, 27, 1, 27, 1, 28, 1, 28, 3, 28, 292, 
		    8, 28, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 3, 29, 301, 
		    8, 29, 1, 30, 1, 30, 1, 30, 5, 30, 306, 8, 30, 10, 30, 12, 30, 309, 
		    9, 30, 1, 31, 1, 31, 1, 31, 5, 31, 314, 8, 31, 10, 31, 12, 31, 317, 
		    9, 31, 1, 32, 1, 32, 1, 32, 5, 32, 322, 8, 32, 10, 32, 12, 32, 325, 
		    9, 32, 1, 33, 1, 33, 1, 33, 5, 33, 330, 8, 33, 10, 33, 12, 33, 333, 
		    9, 33, 1, 34, 1, 34, 1, 34, 5, 34, 338, 8, 34, 10, 34, 12, 34, 341, 
		    9, 34, 1, 35, 1, 35, 1, 35, 5, 35, 346, 8, 35, 10, 35, 12, 35, 349, 
		    9, 35, 1, 36, 1, 36, 1, 36, 3, 36, 354, 8, 36, 1, 37, 1, 37, 1, 37, 
		    1, 37, 5, 37, 360, 8, 37, 10, 37, 12, 37, 363, 9, 37, 1, 38, 1, 38, 
		    1, 39, 1, 39, 1, 39, 1, 39, 1, 40, 1, 40, 3, 40, 373, 8, 40, 1, 40, 
		    1, 40, 1, 41, 1, 41, 1, 41, 1, 41, 1, 41, 1, 41, 1, 41, 1, 41, 3, 
		    41, 385, 8, 41, 1, 42, 1, 42, 1, 42, 1, 42, 1, 42, 1, 42, 3, 42, 393, 
		    8, 42, 1, 42, 1, 42, 1, 43, 1, 43, 1, 43, 5, 43, 400, 8, 43, 10, 43, 
		    12, 43, 403, 9, 43, 1, 43, 3, 43, 406, 8, 43, 1, 44, 1, 44, 1, 44, 
		    3, 44, 411, 8, 44, 1, 44, 3, 44, 414, 8, 44, 1, 45, 1, 45, 1, 45, 
		    1, 45, 1, 45, 3, 45, 421, 8, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 
		    1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 
		    45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 3, 45, 
		    446, 8, 45, 1, 46, 1, 46, 1, 46, 5, 46, 451, 8, 46, 10, 46, 12, 46, 
		    454, 9, 46, 1, 47, 1, 47, 1, 47, 5, 47, 459, 8, 47, 10, 47, 12, 47, 
		    462, 9, 47, 1, 48, 1, 48, 1, 48, 0, 0, 49, 0, 2, 4, 6, 8, 10, 12, 
		    14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 
		    48, 50, 52, 54, 56, 58, 60, 62, 64, 66, 68, 70, 72, 74, 76, 78, 80, 
		    82, 84, 86, 88, 90, 92, 94, 96, 0, 9, 1, 0, 9, 13, 2, 0, 2, 2, 19, 
		    22, 1, 0, 37, 38, 1, 0, 39, 42, 1, 0, 43, 44, 2, 0, 8, 8, 45, 46, 
		    3, 0, 8, 8, 44, 44, 47, 48, 1, 0, 49, 50, 2, 0, 58, 60, 62, 65, 482, 
		    0, 101, 1, 0, 0, 0, 2, 110, 1, 0, 0, 0, 4, 112, 1, 0, 0, 0, 6, 122, 
		    1, 0, 0, 0, 8, 128, 1, 0, 0, 0, 10, 140, 1, 0, 0, 0, 12, 148, 1, 0, 
		    0, 0, 14, 154, 1, 0, 0, 0, 16, 161, 1, 0, 0, 0, 18, 163, 1, 0, 0, 
		    0, 20, 173, 1, 0, 0, 0, 22, 175, 1, 0, 0, 0, 24, 177, 1, 0, 0, 0, 
		    26, 194, 1, 0, 0, 0, 28, 196, 1, 0, 0, 0, 30, 205, 1, 0, 0, 0, 32, 
		    209, 1, 0, 0, 0, 34, 213, 1, 0, 0, 0, 36, 215, 1, 0, 0, 0, 38, 217, 
		    1, 0, 0, 0, 40, 227, 1, 0, 0, 0, 42, 241, 1, 0, 0, 0, 44, 250, 1, 
		    0, 0, 0, 46, 268, 1, 0, 0, 0, 48, 271, 1, 0, 0, 0, 50, 283, 1, 0, 
		    0, 0, 52, 285, 1, 0, 0, 0, 54, 287, 1, 0, 0, 0, 56, 289, 1, 0, 0, 
		    0, 58, 300, 1, 0, 0, 0, 60, 302, 1, 0, 0, 0, 62, 310, 1, 0, 0, 0, 
		    64, 318, 1, 0, 0, 0, 66, 326, 1, 0, 0, 0, 68, 334, 1, 0, 0, 0, 70, 
		    342, 1, 0, 0, 0, 72, 353, 1, 0, 0, 0, 74, 355, 1, 0, 0, 0, 76, 364, 
		    1, 0, 0, 0, 78, 366, 1, 0, 0, 0, 80, 370, 1, 0, 0, 0, 82, 384, 1, 
		    0, 0, 0, 84, 386, 1, 0, 0, 0, 86, 396, 1, 0, 0, 0, 88, 413, 1, 0, 
		    0, 0, 90, 445, 1, 0, 0, 0, 92, 447, 1, 0, 0, 0, 94, 455, 1, 0, 0, 
		    0, 96, 463, 1, 0, 0, 0, 98, 100, 3, 2, 1, 0, 99, 98, 1, 0, 0, 0, 100, 
		    103, 1, 0, 0, 0, 101, 99, 1, 0, 0, 0, 101, 102, 1, 0, 0, 0, 102, 104, 
		    1, 0, 0, 0, 103, 101, 1, 0, 0, 0, 104, 105, 5, 0, 0, 1, 105, 1, 1, 
		    0, 0, 0, 106, 111, 3, 4, 2, 0, 107, 111, 3, 6, 3, 0, 108, 111, 3, 
		    8, 4, 0, 109, 111, 3, 26, 13, 0, 110, 106, 1, 0, 0, 0, 110, 107, 1, 
		    0, 0, 0, 110, 108, 1, 0, 0, 0, 110, 109, 1, 0, 0, 0, 111, 3, 1, 0, 
		    0, 0, 112, 113, 5, 1, 0, 0, 113, 114, 3, 94, 47, 0, 114, 120, 3, 20, 
		    10, 0, 115, 118, 5, 2, 0, 0, 116, 119, 3, 92, 46, 0, 117, 119, 3, 
		    84, 42, 0, 118, 116, 1, 0, 0, 0, 118, 117, 1, 0, 0, 0, 119, 121, 1, 
		    0, 0, 0, 120, 115, 1, 0, 0, 0, 120, 121, 1, 0, 0, 0, 121, 5, 1, 0, 
		    0, 0, 122, 123, 5, 3, 0, 0, 123, 124, 5, 61, 0, 0, 124, 125, 3, 20, 
		    10, 0, 125, 126, 5, 2, 0, 0, 126, 127, 3, 58, 29, 0, 127, 7, 1, 0, 
		    0, 0, 128, 129, 5, 4, 0, 0, 129, 130, 5, 61, 0, 0, 130, 132, 5, 5, 
		    0, 0, 131, 133, 3, 10, 5, 0, 132, 131, 1, 0, 0, 0, 132, 133, 1, 0, 
		    0, 0, 133, 134, 1, 0, 0, 0, 134, 136, 5, 6, 0, 0, 135, 137, 3, 16, 
		    8, 0, 136, 135, 1, 0, 0, 0, 136, 137, 1, 0, 0, 0, 137, 138, 1, 0, 
		    0, 0, 138, 139, 3, 28, 14, 0, 139, 9, 1, 0, 0, 0, 140, 145, 3, 12, 
		    6, 0, 141, 142, 5, 7, 0, 0, 142, 144, 3, 12, 6, 0, 143, 141, 1, 0, 
		    0, 0, 144, 147, 1, 0, 0, 0, 145, 143, 1, 0, 0, 0, 145, 146, 1, 0, 
		    0, 0, 146, 11, 1, 0, 0, 0, 147, 145, 1, 0, 0, 0, 148, 150, 5, 61, 
		    0, 0, 149, 151, 3, 14, 7, 0, 150, 149, 1, 0, 0, 0, 150, 151, 1, 0, 
		    0, 0, 151, 152, 1, 0, 0, 0, 152, 153, 3, 20, 10, 0, 153, 13, 1, 0, 
		    0, 0, 154, 155, 5, 8, 0, 0, 155, 15, 1, 0, 0, 0, 156, 162, 3, 20, 
		    10, 0, 157, 158, 5, 5, 0, 0, 158, 159, 3, 18, 9, 0, 159, 160, 5, 6, 
		    0, 0, 160, 162, 1, 0, 0, 0, 161, 156, 1, 0, 0, 0, 161, 157, 1, 0, 
		    0, 0, 162, 17, 1, 0, 0, 0, 163, 168, 3, 20, 10, 0, 164, 165, 5, 7, 
		    0, 0, 165, 167, 3, 20, 10, 0, 166, 164, 1, 0, 0, 0, 167, 170, 1, 0, 
		    0, 0, 168, 166, 1, 0, 0, 0, 168, 169, 1, 0, 0, 0, 169, 19, 1, 0, 0, 
		    0, 170, 168, 1, 0, 0, 0, 171, 174, 3, 22, 11, 0, 172, 174, 3, 24, 
		    12, 0, 173, 171, 1, 0, 0, 0, 173, 172, 1, 0, 0, 0, 174, 21, 1, 0, 
		    0, 0, 175, 176, 7, 0, 0, 0, 176, 23, 1, 0, 0, 0, 177, 178, 5, 14, 
		    0, 0, 178, 179, 3, 58, 29, 0, 179, 180, 5, 15, 0, 0, 180, 181, 3, 
		    20, 10, 0, 181, 25, 1, 0, 0, 0, 182, 195, 3, 28, 14, 0, 183, 195, 
		    3, 4, 2, 0, 184, 195, 3, 6, 3, 0, 185, 195, 3, 30, 15, 0, 186, 195, 
		    3, 32, 16, 0, 187, 195, 3, 38, 19, 0, 188, 195, 3, 40, 20, 0, 189, 
		    195, 3, 46, 23, 0, 190, 195, 3, 52, 26, 0, 191, 195, 3, 54, 27, 0, 
		    192, 195, 3, 56, 28, 0, 193, 195, 3, 36, 18, 0, 194, 182, 1, 0, 0, 
		    0, 194, 183, 1, 0, 0, 0, 194, 184, 1, 0, 0, 0, 194, 185, 1, 0, 0, 
		    0, 194, 186, 1, 0, 0, 0, 194, 187, 1, 0, 0, 0, 194, 188, 1, 0, 0, 
		    0, 194, 189, 1, 0, 0, 0, 194, 190, 1, 0, 0, 0, 194, 191, 1, 0, 0, 
		    0, 194, 192, 1, 0, 0, 0, 194, 193, 1, 0, 0, 0, 195, 27, 1, 0, 0, 0, 
		    196, 200, 5, 16, 0, 0, 197, 199, 3, 26, 13, 0, 198, 197, 1, 0, 0, 
		    0, 199, 202, 1, 0, 0, 0, 200, 198, 1, 0, 0, 0, 200, 201, 1, 0, 0, 
		    0, 201, 203, 1, 0, 0, 0, 202, 200, 1, 0, 0, 0, 203, 204, 5, 17, 0, 
		    0, 204, 29, 1, 0, 0, 0, 205, 206, 3, 94, 47, 0, 206, 207, 5, 18, 0, 
		    0, 207, 208, 3, 92, 46, 0, 208, 31, 1, 0, 0, 0, 209, 210, 3, 58, 29, 
		    0, 210, 211, 3, 34, 17, 0, 211, 212, 3, 58, 29, 0, 212, 33, 1, 0, 
		    0, 0, 213, 214, 7, 1, 0, 0, 214, 35, 1, 0, 0, 0, 215, 216, 3, 58, 
		    29, 0, 216, 37, 1, 0, 0, 0, 217, 218, 5, 23, 0, 0, 218, 219, 3, 58, 
		    29, 0, 219, 225, 3, 28, 14, 0, 220, 223, 5, 24, 0, 0, 221, 224, 3, 
		    38, 19, 0, 222, 224, 3, 28, 14, 0, 223, 221, 1, 0, 0, 0, 223, 222, 
		    1, 0, 0, 0, 224, 226, 1, 0, 0, 0, 225, 220, 1, 0, 0, 0, 225, 226, 
		    1, 0, 0, 0, 226, 39, 1, 0, 0, 0, 227, 228, 5, 25, 0, 0, 228, 229, 
		    3, 58, 29, 0, 229, 233, 5, 16, 0, 0, 230, 232, 3, 42, 21, 0, 231, 
		    230, 1, 0, 0, 0, 232, 235, 1, 0, 0, 0, 233, 231, 1, 0, 0, 0, 233, 
		    234, 1, 0, 0, 0, 234, 237, 1, 0, 0, 0, 235, 233, 1, 0, 0, 0, 236, 
		    238, 3, 44, 22, 0, 237, 236, 1, 0, 0, 0, 237, 238, 1, 0, 0, 0, 238, 
		    239, 1, 0, 0, 0, 239, 240, 5, 17, 0, 0, 240, 41, 1, 0, 0, 0, 241, 
		    242, 5, 26, 0, 0, 242, 243, 3, 92, 46, 0, 243, 247, 5, 27, 0, 0, 244, 
		    246, 3, 26, 13, 0, 245, 244, 1, 0, 0, 0, 246, 249, 1, 0, 0, 0, 247, 
		    245, 1, 0, 0, 0, 247, 248, 1, 0, 0, 0, 248, 43, 1, 0, 0, 0, 249, 247, 
		    1, 0, 0, 0, 250, 251, 5, 28, 0, 0, 251, 255, 5, 27, 0, 0, 252, 254, 
		    3, 26, 13, 0, 253, 252, 1, 0, 0, 0, 254, 257, 1, 0, 0, 0, 255, 253, 
		    1, 0, 0, 0, 255, 256, 1, 0, 0, 0, 256, 45, 1, 0, 0, 0, 257, 255, 1, 
		    0, 0, 0, 258, 259, 5, 29, 0, 0, 259, 260, 3, 48, 24, 0, 260, 261, 
		    3, 28, 14, 0, 261, 269, 1, 0, 0, 0, 262, 263, 5, 29, 0, 0, 263, 264, 
		    3, 58, 29, 0, 264, 265, 3, 28, 14, 0, 265, 269, 1, 0, 0, 0, 266, 267, 
		    5, 29, 0, 0, 267, 269, 3, 28, 14, 0, 268, 258, 1, 0, 0, 0, 268, 262, 
		    1, 0, 0, 0, 268, 266, 1, 0, 0, 0, 269, 47, 1, 0, 0, 0, 270, 272, 3, 
		    50, 25, 0, 271, 270, 1, 0, 0, 0, 271, 272, 1, 0, 0, 0, 272, 273, 1, 
		    0, 0, 0, 273, 275, 5, 30, 0, 0, 274, 276, 3, 58, 29, 0, 275, 274, 
		    1, 0, 0, 0, 275, 276, 1, 0, 0, 0, 276, 277, 1, 0, 0, 0, 277, 279, 
		    5, 30, 0, 0, 278, 280, 3, 58, 29, 0, 279, 278, 1, 0, 0, 0, 279, 280, 
		    1, 0, 0, 0, 280, 49, 1, 0, 0, 0, 281, 284, 3, 30, 15, 0, 282, 284, 
		    3, 32, 16, 0, 283, 281, 1, 0, 0, 0, 283, 282, 1, 0, 0, 0, 284, 51, 
		    1, 0, 0, 0, 285, 286, 5, 31, 0, 0, 286, 53, 1, 0, 0, 0, 287, 288, 
		    5, 32, 0, 0, 288, 55, 1, 0, 0, 0, 289, 291, 5, 33, 0, 0, 290, 292, 
		    3, 92, 46, 0, 291, 290, 1, 0, 0, 0, 291, 292, 1, 0, 0, 0, 292, 57, 
		    1, 0, 0, 0, 293, 294, 3, 60, 30, 0, 294, 295, 5, 34, 0, 0, 295, 296, 
		    3, 58, 29, 0, 296, 297, 5, 27, 0, 0, 297, 298, 3, 58, 29, 0, 298, 
		    301, 1, 0, 0, 0, 299, 301, 3, 60, 30, 0, 300, 293, 1, 0, 0, 0, 300, 
		    299, 1, 0, 0, 0, 301, 59, 1, 0, 0, 0, 302, 307, 3, 62, 31, 0, 303, 
		    304, 5, 35, 0, 0, 304, 306, 3, 62, 31, 0, 305, 303, 1, 0, 0, 0, 306, 
		    309, 1, 0, 0, 0, 307, 305, 1, 0, 0, 0, 307, 308, 1, 0, 0, 0, 308, 
		    61, 1, 0, 0, 0, 309, 307, 1, 0, 0, 0, 310, 315, 3, 64, 32, 0, 311, 
		    312, 5, 36, 0, 0, 312, 314, 3, 64, 32, 0, 313, 311, 1, 0, 0, 0, 314, 
		    317, 1, 0, 0, 0, 315, 313, 1, 0, 0, 0, 315, 316, 1, 0, 0, 0, 316, 
		    63, 1, 0, 0, 0, 317, 315, 1, 0, 0, 0, 318, 323, 3, 66, 33, 0, 319, 
		    320, 7, 2, 0, 0, 320, 322, 3, 66, 33, 0, 321, 319, 1, 0, 0, 0, 322, 
		    325, 1, 0, 0, 0, 323, 321, 1, 0, 0, 0, 323, 324, 1, 0, 0, 0, 324, 
		    65, 1, 0, 0, 0, 325, 323, 1, 0, 0, 0, 326, 331, 3, 68, 34, 0, 327, 
		    328, 7, 3, 0, 0, 328, 330, 3, 68, 34, 0, 329, 327, 1, 0, 0, 0, 330, 
		    333, 1, 0, 0, 0, 331, 329, 1, 0, 0, 0, 331, 332, 1, 0, 0, 0, 332, 
		    67, 1, 0, 0, 0, 333, 331, 1, 0, 0, 0, 334, 339, 3, 70, 35, 0, 335, 
		    336, 7, 4, 0, 0, 336, 338, 3, 70, 35, 0, 337, 335, 1, 0, 0, 0, 338, 
		    341, 1, 0, 0, 0, 339, 337, 1, 0, 0, 0, 339, 340, 1, 0, 0, 0, 340, 
		    69, 1, 0, 0, 0, 341, 339, 1, 0, 0, 0, 342, 347, 3, 72, 36, 0, 343, 
		    344, 7, 5, 0, 0, 344, 346, 3, 72, 36, 0, 345, 343, 1, 0, 0, 0, 346, 
		    349, 1, 0, 0, 0, 347, 345, 1, 0, 0, 0, 347, 348, 1, 0, 0, 0, 348, 
		    71, 1, 0, 0, 0, 349, 347, 1, 0, 0, 0, 350, 351, 7, 6, 0, 0, 351, 354, 
		    3, 72, 36, 0, 352, 354, 3, 74, 37, 0, 353, 350, 1, 0, 0, 0, 353, 352, 
		    1, 0, 0, 0, 354, 73, 1, 0, 0, 0, 355, 361, 3, 82, 41, 0, 356, 360, 
		    3, 78, 39, 0, 357, 360, 3, 80, 40, 0, 358, 360, 3, 76, 38, 0, 359, 
		    356, 1, 0, 0, 0, 359, 357, 1, 0, 0, 0, 359, 358, 1, 0, 0, 0, 360, 
		    363, 1, 0, 0, 0, 361, 359, 1, 0, 0, 0, 361, 362, 1, 0, 0, 0, 362, 
		    75, 1, 0, 0, 0, 363, 361, 1, 0, 0, 0, 364, 365, 7, 7, 0, 0, 365, 77, 
		    1, 0, 0, 0, 366, 367, 5, 14, 0, 0, 367, 368, 3, 58, 29, 0, 368, 369, 
		    5, 15, 0, 0, 369, 79, 1, 0, 0, 0, 370, 372, 5, 5, 0, 0, 371, 373, 
		    3, 92, 46, 0, 372, 371, 1, 0, 0, 0, 372, 373, 1, 0, 0, 0, 373, 374, 
		    1, 0, 0, 0, 374, 375, 5, 6, 0, 0, 375, 81, 1, 0, 0, 0, 376, 385, 3, 
		    96, 48, 0, 377, 385, 5, 61, 0, 0, 378, 385, 3, 90, 45, 0, 379, 385, 
		    3, 84, 42, 0, 380, 381, 5, 5, 0, 0, 381, 382, 3, 58, 29, 0, 382, 383, 
		    5, 6, 0, 0, 383, 385, 1, 0, 0, 0, 384, 376, 1, 0, 0, 0, 384, 377, 
		    1, 0, 0, 0, 384, 378, 1, 0, 0, 0, 384, 379, 1, 0, 0, 0, 384, 380, 
		    1, 0, 0, 0, 385, 83, 1, 0, 0, 0, 386, 387, 5, 14, 0, 0, 387, 388, 
		    3, 58, 29, 0, 388, 389, 5, 15, 0, 0, 389, 390, 3, 20, 10, 0, 390, 
		    392, 5, 16, 0, 0, 391, 393, 3, 86, 43, 0, 392, 391, 1, 0, 0, 0, 392, 
		    393, 1, 0, 0, 0, 393, 394, 1, 0, 0, 0, 394, 395, 5, 17, 0, 0, 395, 
		    85, 1, 0, 0, 0, 396, 401, 3, 88, 44, 0, 397, 398, 5, 7, 0, 0, 398, 
		    400, 3, 88, 44, 0, 399, 397, 1, 0, 0, 0, 400, 403, 1, 0, 0, 0, 401, 
		    399, 1, 0, 0, 0, 401, 402, 1, 0, 0, 0, 402, 405, 1, 0, 0, 0, 403, 
		    401, 1, 0, 0, 0, 404, 406, 5, 7, 0, 0, 405, 404, 1, 0, 0, 0, 405, 
		    406, 1, 0, 0, 0, 406, 87, 1, 0, 0, 0, 407, 414, 3, 58, 29, 0, 408, 
		    410, 5, 16, 0, 0, 409, 411, 3, 92, 46, 0, 410, 409, 1, 0, 0, 0, 410, 
		    411, 1, 0, 0, 0, 411, 412, 1, 0, 0, 0, 412, 414, 5, 17, 0, 0, 413, 
		    407, 1, 0, 0, 0, 413, 408, 1, 0, 0, 0, 414, 89, 1, 0, 0, 0, 415, 416, 
		    5, 51, 0, 0, 416, 417, 5, 52, 0, 0, 417, 418, 5, 53, 0, 0, 418, 420, 
		    5, 5, 0, 0, 419, 421, 3, 92, 46, 0, 420, 419, 1, 0, 0, 0, 420, 421, 
		    1, 0, 0, 0, 421, 422, 1, 0, 0, 0, 422, 446, 5, 6, 0, 0, 423, 424, 
		    5, 54, 0, 0, 424, 425, 5, 5, 0, 0, 425, 426, 3, 58, 29, 0, 426, 427, 
		    5, 6, 0, 0, 427, 446, 1, 0, 0, 0, 428, 429, 5, 55, 0, 0, 429, 430, 
		    5, 5, 0, 0, 430, 446, 5, 6, 0, 0, 431, 432, 5, 56, 0, 0, 432, 433, 
		    5, 5, 0, 0, 433, 434, 3, 58, 29, 0, 434, 435, 5, 7, 0, 0, 435, 436, 
		    3, 58, 29, 0, 436, 437, 5, 7, 0, 0, 437, 438, 3, 58, 29, 0, 438, 439, 
		    5, 6, 0, 0, 439, 446, 1, 0, 0, 0, 440, 441, 5, 57, 0, 0, 441, 442, 
		    5, 5, 0, 0, 442, 443, 3, 58, 29, 0, 443, 444, 5, 6, 0, 0, 444, 446, 
		    1, 0, 0, 0, 445, 415, 1, 0, 0, 0, 445, 423, 1, 0, 0, 0, 445, 428, 
		    1, 0, 0, 0, 445, 431, 1, 0, 0, 0, 445, 440, 1, 0, 0, 0, 446, 91, 1, 
		    0, 0, 0, 447, 452, 3, 58, 29, 0, 448, 449, 5, 7, 0, 0, 449, 451, 3, 
		    58, 29, 0, 450, 448, 1, 0, 0, 0, 451, 454, 1, 0, 0, 0, 452, 450, 1, 
		    0, 0, 0, 452, 453, 1, 0, 0, 0, 453, 93, 1, 0, 0, 0, 454, 452, 1, 0, 
		    0, 0, 455, 460, 5, 61, 0, 0, 456, 457, 5, 7, 0, 0, 457, 459, 5, 61, 
		    0, 0, 458, 456, 1, 0, 0, 0, 459, 462, 1, 0, 0, 0, 460, 458, 1, 0, 
		    0, 0, 460, 461, 1, 0, 0, 0, 461, 95, 1, 0, 0, 0, 462, 460, 1, 0, 0, 
		    0, 463, 464, 7, 8, 0, 0, 464, 97, 1, 0, 0, 0, 46, 101, 110, 118, 120, 
		    132, 136, 145, 150, 161, 168, 173, 194, 200, 223, 225, 233, 237, 247, 
		    255, 268, 271, 275, 279, 283, 291, 300, 307, 315, 323, 331, 339, 347, 
		    353, 359, 361, 372, 384, 392, 401, 405, 410, 413, 420, 445, 452, 460];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Golampi.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program(): Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(101);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -15322778433404614) !== 0) || $_la === self::STRING || $_la === self::RUNE) {
		        	$this->setState(98);
		        	$this->declaration();
		        	$this->setState(103);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(104);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaration(): Context\DeclarationContext
		{
		    $localContext = new Context\DeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_declaration);

		    try {
		        $this->setState(110);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 1, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(106);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(107);
		        	    $this->constDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(108);
		        	    $this->functionDecl();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(109);
		        	    $this->statement();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_varDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(112);
		        $this->match(self::T__0);
		        $this->setState(113);
		        $this->idList();
		        $this->setState(114);
		        $this->type();
		        $this->setState(120);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__1) {
		        	$this->setState(115);
		        	$this->match(self::T__1);
		        	$this->setState(118);
		        	$this->errorHandler->sync($this);

		        	switch ($this->getInterpreter()->adaptivePredict($this->input, 2, $this->ctx)) {
		        		case 1:
		        		    $this->setState(116);
		        		    $this->exprList();
		        		break;

		        		case 2:
		        		    $this->setState(117);
		        		    $this->arrayLiteral();
		        		break;
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDecl(): Context\ConstDeclContext
		{
		    $localContext = new Context\ConstDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_constDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(122);
		        $this->match(self::T__2);
		        $this->setState(123);
		        $this->match(self::ID);
		        $this->setState(124);
		        $this->type();
		        $this->setState(125);
		        $this->match(self::T__1);
		        $this->setState(126);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDecl(): Context\FunctionDeclContext
		{
		    $localContext = new Context\FunctionDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_functionDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(128);
		        $this->match(self::T__3);
		        $this->setState(129);
		        $this->match(self::ID);
		        $this->setState(130);
		        $this->match(self::T__4);
		        $this->setState(132);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ID) {
		        	$this->setState(131);
		        	$this->parameters();
		        }
		        $this->setState(134);
		        $this->match(self::T__5);
		        $this->setState(136);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 32288) !== 0)) {
		        	$this->setState(135);
		        	$this->returnType();
		        }
		        $this->setState(138);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameters(): Context\ParametersContext
		{
		    $localContext = new Context\ParametersContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_parameters);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(140);
		        $this->parameter();
		        $this->setState(145);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__6) {
		        	$this->setState(141);
		        	$this->match(self::T__6);
		        	$this->setState(142);
		        	$this->parameter();
		        	$this->setState(147);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameter(): Context\ParameterContext
		{
		    $localContext = new Context\ParameterContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_parameter);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(148);
		        $this->match(self::ID);
		        $this->setState(150);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__7) {
		        	$this->setState(149);
		        	$this->pointer();
		        }
		        $this->setState(152);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function pointer(): Context\PointerContext
		{
		    $localContext = new Context\PointerContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_pointer);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(154);
		        $this->match(self::T__7);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnType(): Context\ReturnTypeContext
		{
		    $localContext = new Context\ReturnTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_returnType);

		    try {
		        $this->setState(161);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__8:
		            case self::T__9:
		            case self::T__10:
		            case self::T__11:
		            case self::T__12:
		            case self::T__13:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(156);
		            	$this->type();
		            	break;

		            case self::T__4:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(157);
		            	$this->match(self::T__4);
		            	$this->setState(158);
		            	$this->typeList();
		            	$this->setState(159);
		            	$this->match(self::T__5);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function typeList(): Context\TypeListContext
		{
		    $localContext = new Context\TypeListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_typeList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(163);
		        $this->type();
		        $this->setState(168);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__6) {
		        	$this->setState(164);
		        	$this->match(self::T__6);
		        	$this->setState(165);
		        	$this->type();
		        	$this->setState(170);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_type);

		    try {
		        $this->setState(173);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__8:
		            case self::T__9:
		            case self::T__10:
		            case self::T__11:
		            case self::T__12:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(171);
		            	$this->primitiveType();
		            	break;

		            case self::T__13:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(172);
		            	$this->arrayType();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function primitiveType(): Context\PrimitiveTypeContext
		{
		    $localContext = new Context\PrimitiveTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_primitiveType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(175);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 15872) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayType(): Context\ArrayTypeContext
		{
		    $localContext = new Context\ArrayTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_arrayType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(177);
		        $this->match(self::T__13);
		        $this->setState(178);
		        $this->expression();
		        $this->setState(179);
		        $this->match(self::T__14);
		        $this->setState(180);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_statement);

		    try {
		        $this->setState(194);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 11, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(182);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(183);
		        	    $this->varDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(184);
		        	    $this->constDecl();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(185);
		        	    $this->shortVarDecl();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(186);
		        	    $this->assignment();
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(187);
		        	    $this->ifStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(188);
		        	    $this->switchStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(189);
		        	    $this->forStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(190);
		        	    $this->breakStmt();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(191);
		        	    $this->continueStmt();
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(192);
		        	    $this->returnStmt();
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(193);
		        	    $this->exprStmt();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(196);
		        $this->match(self::T__15);
		        $this->setState(200);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -15322778433404630) !== 0) || $_la === self::STRING || $_la === self::RUNE) {
		        	$this->setState(197);
		        	$this->statement();
		        	$this->setState(202);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(203);
		        $this->match(self::T__16);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDecl(): Context\ShortVarDeclContext
		{
		    $localContext = new Context\ShortVarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_shortVarDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(205);
		        $this->idList();
		        $this->setState(206);
		        $this->match(self::T__17);
		        $this->setState(207);
		        $this->exprList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment(): Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_assignment);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(209);
		        $this->expression();
		        $this->setState(210);
		        $this->assignOp();
		        $this->setState(211);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignOp(): Context\AssignOpContext
		{
		    $localContext = new Context\AssignOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_assignOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(213);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 7864324) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function exprStmt(): Context\ExprStmtContext
		{
		    $localContext = new Context\ExprStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_exprStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(215);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(217);
		        $this->match(self::T__22);
		        $this->setState(218);
		        $this->expression();
		        $this->setState(219);
		        $this->block();
		        $this->setState(225);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__23) {
		        	$this->setState(220);
		        	$this->match(self::T__23);
		        	$this->setState(223);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::T__22:
		        	    	$this->setState(221);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::T__15:
		        	    	$this->setState(222);
		        	    	$this->block();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(227);
		        $this->match(self::T__24);
		        $this->setState(228);
		        $this->expression();
		        $this->setState(229);
		        $this->match(self::T__15);
		        $this->setState(233);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__25) {
		        	$this->setState(230);
		        	$this->caseClause();
		        	$this->setState(235);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(237);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__27) {
		        	$this->setState(236);
		        	$this->defaultClause();
		        }
		        $this->setState(239);
		        $this->match(self::T__16);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseClause(): Context\CaseClauseContext
		{
		    $localContext = new Context\CaseClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_caseClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(241);
		        $this->match(self::T__25);
		        $this->setState(242);
		        $this->exprList();
		        $this->setState(243);
		        $this->match(self::T__26);
		        $this->setState(247);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -15322778433404630) !== 0) || $_la === self::STRING || $_la === self::RUNE) {
		        	$this->setState(244);
		        	$this->statement();
		        	$this->setState(249);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultClause(): Context\DefaultClauseContext
		{
		    $localContext = new Context\DefaultClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_defaultClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(250);
		        $this->match(self::T__27);
		        $this->setState(251);
		        $this->match(self::T__26);
		        $this->setState(255);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -15322778433404630) !== 0) || $_la === self::STRING || $_la === self::RUNE) {
		        	$this->setState(252);
		        	$this->statement();
		        	$this->setState(257);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_forStmt);

		    try {
		        $this->setState(268);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(258);
		        	    $this->match(self::T__28);
		        	    $this->setState(259);
		        	    $this->forClause();
		        	    $this->setState(260);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(262);
		        	    $this->match(self::T__28);
		        	    $this->setState(263);
		        	    $this->expression();
		        	    $this->setState(264);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(266);
		        	    $this->match(self::T__28);
		        	    $this->setState(267);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forClause(): Context\ForClauseContext
		{
		    $localContext = new Context\ForClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_forClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(271);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899798025) !== 0)) {
		        	$this->setState(270);
		        	$this->forInit();
		        }
		        $this->setState(273);
		        $this->match(self::T__29);
		        $this->setState(275);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899798025) !== 0)) {
		        	$this->setState(274);
		        	$this->expression();
		        }
		        $this->setState(277);
		        $this->match(self::T__29);
		        $this->setState(279);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899798025) !== 0)) {
		        	$this->setState(278);
		        	$this->expression();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forInit(): Context\ForInitContext
		{
		    $localContext = new Context\ForInitContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_forInit);

		    try {
		        $this->setState(283);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 23, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(281);
		        	    $this->shortVarDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(282);
		        	    $this->assignment();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(285);
		        $this->match(self::T__30);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(287);
		        $this->match(self::T__31);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(289);
		        $this->match(self::T__32);
		        $this->setState(291);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 24, $this->ctx)) {
		            case 1:
		        	    $this->setState(290);
		        	    $this->exprList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression(): Context\ExpressionContext
		{
		    $localContext = new Context\ExpressionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_expression);

		    try {
		        $this->setState(300);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 25, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(293);
		        	    $this->logicalOr();
		        	    $this->setState(294);
		        	    $this->match(self::T__33);
		        	    $this->setState(295);
		        	    $this->expression();
		        	    $this->setState(296);
		        	    $this->match(self::T__26);
		        	    $this->setState(297);
		        	    $this->expression();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(299);
		        	    $this->logicalOr();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalOr(): Context\LogicalOrContext
		{
		    $localContext = new Context\LogicalOrContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_logicalOr);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(302);
		        $this->logicalAnd();
		        $this->setState(307);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__34) {
		        	$this->setState(303);
		        	$this->match(self::T__34);
		        	$this->setState(304);
		        	$this->logicalAnd();
		        	$this->setState(309);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalAnd(): Context\LogicalAndContext
		{
		    $localContext = new Context\LogicalAndContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_logicalAnd);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(310);
		        $this->equality();
		        $this->setState(315);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__35) {
		        	$this->setState(311);
		        	$this->match(self::T__35);
		        	$this->setState(312);
		        	$this->equality();
		        	$this->setState(317);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function equality(): Context\EqualityContext
		{
		    $localContext = new Context\EqualityContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_equality);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(318);
		        $this->relational();
		        $this->setState(323);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__36 || $_la === self::T__37) {
		        	$this->setState(319);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::T__36 || $_la === self::T__37)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(320);
		        	$this->relational();
		        	$this->setState(325);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function relational(): Context\RelationalContext
		{
		    $localContext = new Context\RelationalContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_relational);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(326);
		        $this->additive();
		        $this->setState(331);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 8246337208320) !== 0)) {
		        	$this->setState(327);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 8246337208320) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(328);
		        	$this->additive();
		        	$this->setState(333);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function additive(): Context\AdditiveContext
		{
		    $localContext = new Context\AdditiveContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_additive);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(334);
		        $this->multiplicative();
		        $this->setState(339);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 30, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(335);

		        		$_la = $this->input->LA(1);

		        		if (!($_la === self::T__42 || $_la === self::T__43)) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(336);
		        		$this->multiplicative(); 
		        	}

		        	$this->setState(341);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 30, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function multiplicative(): Context\MultiplicativeContext
		{
		    $localContext = new Context\MultiplicativeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_multiplicative);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(342);
		        $this->unary();
		        $this->setState(347);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 31, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(343);

		        		$_la = $this->input->LA(1);

		        		if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 105553116266752) !== 0))) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(344);
		        		$this->unary(); 
		        	}

		        	$this->setState(349);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 31, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function unary(): Context\UnaryContext
		{
		    $localContext = new Context\UnaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 72, self::RULE_unary);

		    try {
		        $this->setState(353);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__7:
		            case self::T__43:
		            case self::T__46:
		            case self::T__47:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(350);

		            	$_la = $this->input->LA(1);

		            	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 439804651110656) !== 0))) {
		            	$this->errorHandler->recoverInline($this);
		            	} else {
		            		if ($this->input->LA(1) === Token::EOF) {
		            		    $this->matchedEOF = true;
		            	    }

		            		$this->errorHandler->reportMatch($this);
		            		$this->consume();
		            	}
		            	$this->setState(351);
		            	$this->unary();
		            	break;

		            case self::T__4:
		            case self::T__13:
		            case self::T__50:
		            case self::T__53:
		            case self::T__54:
		            case self::T__55:
		            case self::T__56:
		            case self::T__57:
		            case self::T__58:
		            case self::T__59:
		            case self::ID:
		            case self::INT:
		            case self::FLOAT:
		            case self::STRING:
		            case self::RUNE:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(352);
		            	$this->postfix();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function postfix(): Context\PostfixContext
		{
		    $localContext = new Context\PostfixContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 74, self::RULE_postfix);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(355);
		        $this->primary();
		        $this->setState(361);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(359);
		        		$this->errorHandler->sync($this);

		        		switch ($this->input->LA(1)) {
		        		    case self::T__13:
		        		    	$this->setState(356);
		        		    	$this->index();
		        		    	break;

		        		    case self::T__4:
		        		    	$this->setState(357);
		        		    	$this->call();
		        		    	break;

		        		    case self::T__48:
		        		    case self::T__49:
		        		    	$this->setState(358);
		        		    	$this->incrementOp();
		        		    	break;

		        		default:
		        			throw new NoViableAltException($this);
		        		} 
		        	}

		        	$this->setState(363);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function incrementOp(): Context\IncrementOpContext
		{
		    $localContext = new Context\IncrementOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 76, self::RULE_incrementOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(364);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::T__48 || $_la === self::T__49)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function index(): Context\IndexContext
		{
		    $localContext = new Context\IndexContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 78, self::RULE_index);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(366);
		        $this->match(self::T__13);
		        $this->setState(367);
		        $this->expression();
		        $this->setState(368);
		        $this->match(self::T__14);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function call(): Context\CallContext
		{
		    $localContext = new Context\CallContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 80, self::RULE_call);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(370);
		        $this->match(self::T__4);
		        $this->setState(372);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899798025) !== 0)) {
		        	$this->setState(371);
		        	$this->exprList();
		        }
		        $this->setState(374);
		        $this->match(self::T__5);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function primary(): Context\PrimaryContext
		{
		    $localContext = new Context\PrimaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 82, self::RULE_primary);

		    try {
		        $this->setState(384);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__57:
		            case self::T__58:
		            case self::T__59:
		            case self::INT:
		            case self::FLOAT:
		            case self::STRING:
		            case self::RUNE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(376);
		            	$this->literal();
		            	break;

		            case self::ID:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(377);
		            	$this->match(self::ID);
		            	break;

		            case self::T__50:
		            case self::T__53:
		            case self::T__54:
		            case self::T__55:
		            case self::T__56:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(378);
		            	$this->builtinCall();
		            	break;

		            case self::T__13:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(379);
		            	$this->arrayLiteral();
		            	break;

		            case self::T__4:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(380);
		            	$this->match(self::T__4);
		            	$this->setState(381);
		            	$this->expression();
		            	$this->setState(382);
		            	$this->match(self::T__5);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral(): Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 84, self::RULE_arrayLiteral);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(386);
		        $this->match(self::T__13);
		        $this->setState(387);
		        $this->expression();
		        $this->setState(388);
		        $this->match(self::T__14);
		        $this->setState(389);
		        $this->type();
		        $this->setState(390);
		        $this->match(self::T__15);
		        $this->setState(392);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899800073) !== 0)) {
		        	$this->setState(391);
		        	$this->arrayElements();
		        }
		        $this->setState(394);
		        $this->match(self::T__16);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElements(): Context\ArrayElementsContext
		{
		    $localContext = new Context\ArrayElementsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 86, self::RULE_arrayElements);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(396);
		        $this->arrayElement();
		        $this->setState(401);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(397);
		        		$this->match(self::T__6);
		        		$this->setState(398);
		        		$this->arrayElement(); 
		        	}

		        	$this->setState(403);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx);
		        }
		        $this->setState(405);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__6) {
		        	$this->setState(404);
		        	$this->match(self::T__6);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElement(): Context\ArrayElementContext
		{
		    $localContext = new Context\ArrayElementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 88, self::RULE_arrayElement);

		    try {
		        $this->setState(413);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__4:
		            case self::T__7:
		            case self::T__13:
		            case self::T__43:
		            case self::T__46:
		            case self::T__47:
		            case self::T__50:
		            case self::T__53:
		            case self::T__54:
		            case self::T__55:
		            case self::T__56:
		            case self::T__57:
		            case self::T__58:
		            case self::T__59:
		            case self::ID:
		            case self::INT:
		            case self::FLOAT:
		            case self::STRING:
		            case self::RUNE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(407);
		            	$this->expression();
		            	break;

		            case self::T__15:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(408);
		            	$this->match(self::T__15);
		            	$this->setState(410);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899798025) !== 0)) {
		            		$this->setState(409);
		            		$this->exprList();
		            	}
		            	$this->setState(412);
		            	$this->match(self::T__16);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function builtinCall(): Context\BuiltinCallContext
		{
		    $localContext = new Context\BuiltinCallContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 90, self::RULE_builtinCall);

		    try {
		        $this->setState(445);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__50:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(415);
		            	$this->match(self::T__50);
		            	$this->setState(416);
		            	$this->match(self::T__51);
		            	$this->setState(417);
		            	$this->match(self::T__52);
		            	$this->setState(418);
		            	$this->match(self::T__4);
		            	$this->setState(420);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ((((($_la - 5)) & ~0x3f) === 0 && ((1 << ($_la - 5)) & 2305364171899798025) !== 0)) {
		            		$this->setState(419);
		            		$this->exprList();
		            	}
		            	$this->setState(422);
		            	$this->match(self::T__5);
		            	break;

		            case self::T__53:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(423);
		            	$this->match(self::T__53);
		            	$this->setState(424);
		            	$this->match(self::T__4);
		            	$this->setState(425);
		            	$this->expression();
		            	$this->setState(426);
		            	$this->match(self::T__5);
		            	break;

		            case self::T__54:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(428);
		            	$this->match(self::T__54);
		            	$this->setState(429);
		            	$this->match(self::T__4);
		            	$this->setState(430);
		            	$this->match(self::T__5);
		            	break;

		            case self::T__55:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(431);
		            	$this->match(self::T__55);
		            	$this->setState(432);
		            	$this->match(self::T__4);
		            	$this->setState(433);
		            	$this->expression();
		            	$this->setState(434);
		            	$this->match(self::T__6);
		            	$this->setState(435);
		            	$this->expression();
		            	$this->setState(436);
		            	$this->match(self::T__6);
		            	$this->setState(437);
		            	$this->expression();
		            	$this->setState(438);
		            	$this->match(self::T__5);
		            	break;

		            case self::T__56:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(440);
		            	$this->match(self::T__56);
		            	$this->setState(441);
		            	$this->match(self::T__4);
		            	$this->setState(442);
		            	$this->expression();
		            	$this->setState(443);
		            	$this->match(self::T__5);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function exprList(): Context\ExprListContext
		{
		    $localContext = new Context\ExprListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 92, self::RULE_exprList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(447);
		        $this->expression();
		        $this->setState(452);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__6) {
		        	$this->setState(448);
		        	$this->match(self::T__6);
		        	$this->setState(449);
		        	$this->expression();
		        	$this->setState(454);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function idList(): Context\IdListContext
		{
		    $localContext = new Context\IdListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 94, self::RULE_idList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(455);
		        $this->match(self::ID);
		        $this->setState(460);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__6) {
		        	$this->setState(456);
		        	$this->match(self::T__6);
		        	$this->setState(457);
		        	$this->match(self::ID);
		        	$this->setState(462);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function literal(): Context\LiteralContext
		{
		    $localContext = new Context\LiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 96, self::RULE_literal);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(463);

		        $_la = $this->input->LA(1);

		        if (!((((($_la - 58)) & ~0x3f) === 0 && ((1 << ($_la - 58)) & 247) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}
	}
}

namespace Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use GolampiParser;
	use GolampiVisitor;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declaration;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function functionDecl(): ?FunctionDeclContext
	    {
	    	return $this->getTypedRuleContext(FunctionDeclContext::class, 0);
	    }

	    public function statement(): ?StatementContext
	    {
	    	return $this->getTypedRuleContext(StatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaration($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_varDecl;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_constDecl;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_functionDecl;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parameters(): ?ParametersContext
	    {
	    	return $this->getTypedRuleContext(ParametersContext::class, 0);
	    }

	    public function returnType(): ?ReturnTypeContext
	    {
	    	return $this->getTypedRuleContext(ReturnTypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFunctionDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParametersContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parameters;
	    }

	    /**
	     * @return array<ParameterContext>|ParameterContext|null
	     */
	    public function parameter(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParameterContext::class);
	    	}

	        return $this->getTypedRuleContext(ParameterContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParameters($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parameter;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function pointer(): ?PointerContext
	    {
	    	return $this->getTypedRuleContext(PointerContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParameter($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PointerContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_pointer;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPointer($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnType;
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function typeList(): ?TypeListContext
	    {
	    	return $this->getTypedRuleContext(TypeListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_typeList;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitTypeList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_type;
	    }

	    public function primitiveType(): ?PrimitiveTypeContext
	    {
	    	return $this->getTypedRuleContext(PrimitiveTypeContext::class, 0);
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrimitiveTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_primitiveType;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPrimitiveType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayType;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_statement;
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function exprStmt(): ?ExprStmtContext
	    {
	    	return $this->getTypedRuleContext(ExprStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_block;
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_shortVarDecl;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitShortVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_assignment;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function assignOp(): ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_assignOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExprStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_exprStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_ifStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<CaseClauseContext>|CaseClauseContext|null
	     */
	    public function caseClause(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseClauseContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseClauseContext::class, $index);
	    }

	    public function defaultClause(): ?DefaultClauseContext
	    {
	    	return $this->getTypedRuleContext(DefaultClauseContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_caseClause;
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCaseClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_defaultClause;
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDefaultClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forStmt;
	    }

	    public function forClause(): ?ForClauseContext
	    {
	    	return $this->getTypedRuleContext(ForClauseContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forClause;
	    }

	    public function forInit(): ?ForInitContext
	    {
	    	return $this->getTypedRuleContext(ForInitContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForInitContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forInit;
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForInit($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_breakStmt;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_continueStmt;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnStmt;
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expression;
	    }

	    public function logicalOr(): ?LogicalOrContext
	    {
	    	return $this->getTypedRuleContext(LogicalOrContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpression($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalOrContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_logicalOr;
	    }

	    /**
	     * @return array<LogicalAndContext>|LogicalAndContext|null
	     */
	    public function logicalAnd(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(LogicalAndContext::class);
	    	}

	        return $this->getTypedRuleContext(LogicalAndContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLogicalOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalAndContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_logicalAnd;
	    }

	    /**
	     * @return array<EqualityContext>|EqualityContext|null
	     */
	    public function equality(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(EqualityContext::class);
	    	}

	        return $this->getTypedRuleContext(EqualityContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLogicalAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class EqualityContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_equality;
	    }

	    /**
	     * @return array<RelationalContext>|RelationalContext|null
	     */
	    public function relational(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(RelationalContext::class);
	    	}

	        return $this->getTypedRuleContext(RelationalContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitEquality($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class RelationalContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_relational;
	    }

	    /**
	     * @return array<AdditiveContext>|AdditiveContext|null
	     */
	    public function additive(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(AdditiveContext::class);
	    	}

	        return $this->getTypedRuleContext(AdditiveContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRelational($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AdditiveContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_additive;
	    }

	    /**
	     * @return array<MultiplicativeContext>|MultiplicativeContext|null
	     */
	    public function multiplicative(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(MultiplicativeContext::class);
	    	}

	        return $this->getTypedRuleContext(MultiplicativeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAdditive($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class MultiplicativeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_multiplicative;
	    }

	    /**
	     * @return array<UnaryContext>|UnaryContext|null
	     */
	    public function unary(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(UnaryContext::class);
	    	}

	        return $this->getTypedRuleContext(UnaryContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitMultiplicative($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UnaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_unary;
	    }

	    public function unary(): ?UnaryContext
	    {
	    	return $this->getTypedRuleContext(UnaryContext::class, 0);
	    }

	    public function postfix(): ?PostfixContext
	    {
	    	return $this->getTypedRuleContext(PostfixContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PostfixContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_postfix;
	    }

	    public function primary(): ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

	    /**
	     * @return array<IndexContext>|IndexContext|null
	     */
	    public function index(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(IndexContext::class);
	    	}

	        return $this->getTypedRuleContext(IndexContext::class, $index);
	    }

	    /**
	     * @return array<CallContext>|CallContext|null
	     */
	    public function call(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CallContext::class);
	    	}

	        return $this->getTypedRuleContext(CallContext::class, $index);
	    }

	    /**
	     * @return array<IncrementOpContext>|IncrementOpContext|null
	     */
	    public function incrementOp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(IncrementOpContext::class);
	    	}

	        return $this->getTypedRuleContext(IncrementOpContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPostfix($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IncrementOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_incrementOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIncrementOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IndexContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_index;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIndex($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CallContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_call;
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrimaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_primary;
	    }

	    public function literal(): ?LiteralContext
	    {
	    	return $this->getTypedRuleContext(LiteralContext::class, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function builtinCall(): ?BuiltinCallContext
	    {
	    	return $this->getTypedRuleContext(BuiltinCallContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPrimary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayLiteral;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayElements;
	    }

	    /**
	     * @return array<ArrayElementContext>|ArrayElementContext|null
	     */
	    public function arrayElement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayElementContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayElementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayElements($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayElement;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayElement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BuiltinCallContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_builtinCall;
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBuiltinCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExprListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_exprList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IdListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_idList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIdList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_literal;
	    }

	    public function INT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT, 0);
	    }

	    public function FLOAT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

	    public function RUNE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}