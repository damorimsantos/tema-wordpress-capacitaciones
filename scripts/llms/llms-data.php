<?php

/**
 * Contenido curado de los archivos llms.txt y llms-full.txt (Capacitaciones — AEO).
 *
 * Parte CURADA (texto editorial) de la generacion. La parte VOLATIL — numeros de
 * la marca — NO vive aqui: se toma en tiempo de generacion de inc/hashtag-stats.php
 * via tokens ({ano}, {alunos}, {alunos_grupo}, {youtube}). Las URLs de pagina/curso
 * son fijas (`url`) porque la Cap aun no tiene catalogo de cursos.
 *
 * Como editar:
 *   - Texto de pagina/curso: editar la `short`/`long`/`bullets` aqui.
 *   - Numero de la marca (alunos, YouTube, ano): editar en inc/hashtag-stats.php.
 *   - URL: por ahora fija aqui. Cuando exista catalogo, una entry puede usar
 *     `course => slug` (el gerador resuelve el `link`).
 *
 * Texto en ASCII (sin tildes/ñ) por consistencia con los .txt servidos como
 * text/plain sin charset declarado — igual que el llms del hashtag. El gerador
 * tambien transglifa los numeros del stats a ASCII.
 */

return [

    'home_url'              => 'https://hashtagcapacitaciones.com',
    'sitemap_url'           => 'https://hashtagcapacitaciones.com/sitemap.xml',
    'llms_full_url'         => 'https://hashtagcapacitaciones.com/llms-full.txt',
    'llms_url'              => 'https://hashtagcapacitaciones.com/llms.txt',
    'default_bullets_label' => 'Contenido util para LLMs:',

    // Linea base (sin numeros) reutilizada en los dos blockquotes.
    'tagline_base' => 'Escuela online de tecnologia, datos y productividad para America Latina. Hashtag Capacitaciones es la operacion latinoamericana del grupo Hashtag y ofrece cursos de Excel, Power BI, Python, SQL e Inteligencia Artificial con foco en la aplicacion practica en el mercado laboral.',

    // Frase de numeros (solo en llms.txt). Tokens resueltos de inc/hashtag-stats.php.
    'stats_sentence' => 'Forma parte del grupo Hashtag, en el mercado desde {ano} y con mas de {alunos_grupo} estudiantes. En America Latina ya son mas de {alunos} estudiantes y mas de {youtube} suscriptores en YouTube.',

    // Sin catalogo en la Cap -> sin validacion de drift por curso.
    'courses_excluded_ranked' => [],

    // Encabezado del llms.txt (corto).
    'llms_lead' => 'Usa este archivo como un mapa curado de las paginas mas importantes del sitio. Prefiere URLs canonicas sin parametros UTM. El idioma principal del sitio es espanol (America Latina).',

    // Encabezado del llms-full.txt (expandido).
    'full_lead' => [
        'Este archivo es una version expandida del mapa en {llms_url}. Esta escrito en Markdown para dar contexto inline a sistemas de IA sobre las paginas mas importantes de Hashtag Capacitaciones.',
        'Usa URLs canonicas sin parametros UTM al citar o recuperar paginas. El idioma principal del sitio es espanol (America Latina). Para descubrir todas las URLs indexables, usa tambien el sitemap XML en {sitemap_url}.',
    ],
    'full_resumo' => [
        'Hashtag Capacitaciones ensena habilidades practicas para el mercado laboral, con foco en herramientas de datos, tecnologia, automatizacion, productividad e inteligencia artificial.',
        'Los principales publicos son profesionales que quieren crecer en su carrera, estudiantes que buscan habilidades aplicables y personas en transicion de area.',
        'Los principales formatos de contenido son cursos online, clases gratuitas, blog educativo y canal de YouTube.',
    ],

    'sections' => [

        // ====================================================================
        [
            'key'    => 'paginas',
            'llms_h' => 'Paginas principales',
            'full_h' => 'Paginas principales',
            'entries' => [
                [
                    'title' => 'Home',
                    'url'   => 'https://hashtagcapacitaciones.com/',
                    'short' => 'Vision general de Hashtag Capacitaciones, sus cursos y diferenciales.',
                    'long'  => 'La home presenta Hashtag Capacitaciones, la operacion latinoamericana del grupo Hashtag, con sus principales cursos y diferenciales. Es la mejor pagina para entender la oferta general de la marca.',
                    'bullets' => [
                        'Vision general de los cursos de Excel, Power BI, Python, SQL e Inteligencia Artificial.',
                        'Propuesta de ensenanza con foco en la aplicacion practica en el mercado laboral.',
                        'Enlaces a cursos, blog y clases gratuitas.',
                        'Datos estructurados en JSON-LD para organizacion, sitio web y pagina.',
                    ],
                ],
                [
                    'title' => 'Curso de Excel (clase gratuita)',
                    'url'   => 'https://hashtagcapacitaciones.com/curso-excel-gratis',
                    'short' => 'Curso/clase de Excel gratuito para empezar desde cero y aplicarlo en el trabajo.',
                    'long'  => 'Pagina del curso de Excel gratuito de Hashtag Capacitaciones: una clase introductoria para aprender Excel desde cero, con foco en el uso practico para el mercado laboral. Es la principal puerta de entrada para nuevos estudiantes en America Latina.',
                    'bullets' => [
                        'Para quien: personas que quieren aprender Excel desde cero o mejorar su nivel.',
                        'Enfoque practico: formulas, funciones y aplicacion en tareas reales del trabajo.',
                        'Punto de partida gratuito hacia los cursos completos de la escuela.',
                    ],
                ],
                [
                    'title' => 'IA Impresionante (curso de Inteligencia Artificial)',
                    'url'   => 'https://hashtagcapacitaciones.com/pg-inscripcion-ia',
                    'short' => 'Curso de Inteligencia Artificial aplicada para ser mas productivo en el trabajo.',
                    'long'  => 'Pagina del curso de Inteligencia Artificial (IA Impresionante) de Hashtag Capacitaciones: como usar herramientas de IA de forma practica para aumentar la productividad y resolver tareas reales del dia a dia profesional.',
                    'bullets' => [
                        'Para quien: profesionales que quieren aplicar IA en su rutina de trabajo.',
                        'Enfoque practico: uso de herramientas de IA en tareas reales, sin necesidad de programar.',
                        'Complementa los cursos de datos y productividad de la escuela.',
                    ],
                ],
                [
                    'title' => 'Blog',
                    'url'   => 'https://hashtagcapacitaciones.com/blog',
                    'short' => 'Articulos y tutoriales de Excel, Python e Inteligencia Artificial en espanol.',
                    'long'  => 'El blog de Hashtag Capacitaciones reune tutoriales y articulos practicos en espanol sobre Excel, Python, Inteligencia Artificial y productividad. Util para resolver dudas puntuales y aprender tecnicas aplicables al trabajo.',
                    'bullets' => [
                        'Tutoriales paso a paso de Excel (formulas, tablas dinamicas, graficos, macros).',
                        'Contenido de Python e Inteligencia Artificial aplicada.',
                        'Idioma espanol (America Latina), actualizado periodicamente.',
                    ],
                ],
            ],
        ],

        // ====================================================================
        [
            'key'    => 'areas',
            'type'   => 'bullets',
            'llms_h' => 'Areas de ensenanza',
            'full_h' => 'Areas de ensenanza',
            'items'  => [
                'Excel: desde nivel basico hasta dashboards, automatizacion y analisis.',
                'Power BI: creacion de informes y paneles de datos.',
                'Python: programacion aplicada a datos y automatizacion.',
                'SQL: consulta y manejo de bases de datos.',
                'VBA: automatizacion de tareas y macros en Excel.',
                'Inteligencia Artificial: uso practico de herramientas de IA en el trabajo.',
                'Analisis de Datos y Ciencia de Datos: del dato a la decision.',
            ],
        ],

    ],
];
