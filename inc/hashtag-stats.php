<?php

/**
 * Fonte unica de verdade dos numeros/estatisticas da Hashtag Capacitaciones.
 *
 * Porte enxuto do inc/hashtag-stats.php do hashtag, com os numeros REAIS da
 * operacao LatAm (Capacitaciones) — nao herdar os do grupo BR (Regra 14: cada
 * marca tem numeros proprios). Usado pelo bloco answer-first da home e pelo
 * gerador de llms.txt. Atualizar APENAS os valores em hashtag_stats_data().
 *
 * Numeros (Diego, 2026-06-25):
 *   - Alunos Capacitaciones (LatAm; emails unicos com alguma compra): 2.707
 *   - Alunos do grupo Hashtag (BR + LatAm): 205.100 (respaldo/autoridade)
 *   - Inscritos no YouTube do canal da Cap (UCX0YWZfjcj31zllHDhmmlQw): ~178 mil
 *   - SEM nota no Google (ainda) e SEM Reclame Aqui (operacao BR) -> os helpers
 *     desses campos retornam '' / 0 e os consumidores (answer-first/llms) omitem.
 *   - Ano de fundacao: 2015 (do GRUPO Hashtag; a Cap nao tem ano de inicio proprio
 *     cravado -> usa-se a autoridade factual do grupo, enquadrada como "grupo").
 */

if (!function_exists('hashtag_stats_data')) {
    /**
     * Retorna o array bruto de estatisticas da Cap. Atualize os valores aqui.
     */
    function hashtag_stats_data()
    {
        return [
            // Alunos da operacao LatAm (Capacitaciones)
            'alunos_total'              => 2707,
            'alunos_formatado_curto'    => '+2.700',   // "+2.700 estudiantes"
            'alunos_formatado_curto_np' => '2.700',    // sem "+", apos "mas de"
            'alunos_formatado_completo' => '2.707',

            // Alunos do GRUPO Hashtag (BR + LatAm) — prova de autoridade do grupo
            'alunos_grupo_total'            => 205100,
            'alunos_grupo_formatado_curto'  => '+205 mil',
            'alunos_grupo_formatado_curto_np' => '205 mil',

            // Empresa (ano do grupo Hashtag)
            'ano_fundacao'              => 2015,

            // YouTube — canal da Cap (@hashtagcapacitaciones)
            'youtube_inscritos_curto'   => '178 mil',
            'youtube_inscritos_total'   => 178000,

            // Sem prova social externa propria na operacao LatAm (ainda).
            // Vazios de proposito -> helpers retornam '' / 0 -> KPI/llms omitem.
            'google_nota'               => '',
            'google_avaliacoes'         => 0,
            'ra_selo'                   => '',
            'ra_nota_10'                => '',
            'empresas_atendidas_curto'  => '',
            'empresas_atendidas_total'  => 0,
        ];
    }
}

if (!function_exists('hashtag_alunos_total')) {
    /** Inteiro com o total de alunos da Cap (LatAm). */
    function hashtag_alunos_total()
    {
        return (int) hashtag_stats_data()['alunos_total'];
    }
}

if (!function_exists('hashtag_alunos_formatado')) {
    /**
     * String formatada com o total de alunos da Cap.
     *
     * @param string $tipo "curto" (default) "+2.700" | "curto-np" "2.700" | "completo" "2.707".
     */
    function hashtag_alunos_formatado($tipo = 'curto')
    {
        $stats = hashtag_stats_data();
        switch ($tipo) {
            case 'completo':
                return $stats['alunos_formatado_completo'];
            case 'curto-np':
            case 'curto-sem-prefixo':
                return $stats['alunos_formatado_curto_np'];
            case 'curto':
            default:
                return $stats['alunos_formatado_curto'];
        }
    }
}

if (!function_exists('hashtag_alunos_grupo')) {
    /**
     * String formatada com o total de alunos do GRUPO Hashtag (autoridade).
     *
     * @param string $tipo "curto" (default) "+205 mil" | "curto-np" "205 mil".
     */
    function hashtag_alunos_grupo($tipo = 'curto')
    {
        $stats = hashtag_stats_data();
        return $tipo === 'curto-np'
            ? $stats['alunos_grupo_formatado_curto_np']
            : $stats['alunos_grupo_formatado_curto'];
    }
}

if (!function_exists('hashtag_anos_mercado')) {
    /** Anos de mercado do grupo Hashtag, calculado vs ano de fundacao. */
    function hashtag_anos_mercado()
    {
        return (int) date('Y') - (int) hashtag_stats_data()['ano_fundacao'];
    }
}

if (!function_exists('hashtag_youtube_inscritos')) {
    /** String dos inscritos no YouTube do canal da Cap (ex.: "178 mil"). */
    function hashtag_youtube_inscritos()
    {
        return hashtag_stats_data()['youtube_inscritos_curto'];
    }
}

if (!function_exists('hashtag_google_nota')) {
    /** Nota media no Google (string PT/ES com virgula) ou '' se a Cap nao tem ainda. */
    function hashtag_google_nota()
    {
        return (string) hashtag_stats_data()['google_nota'];
    }
}

if (!function_exists('hashtag_google_avaliacoes')) {
    /** Numero de avaliacoes no Google (0 se a Cap nao tem ainda). */
    function hashtag_google_avaliacoes($tipo = 'int')
    {
        $n = (int) hashtag_stats_data()['google_avaliacoes'];
        return $tipo === 'completo' ? number_format($n, 0, ',', '.') : $n;
    }
}

if (!function_exists('hashtag_ra_selo')) {
    /** Selo Reclame Aqui ('' na Cap — operacao BR). */
    function hashtag_ra_selo()
    {
        return (string) hashtag_stats_data()['ra_selo'];
    }
}

if (!function_exists('hashtag_empresas_atendidas')) {
    /** Empresas atendidas ('' na Cap — sem numero proprio). */
    function hashtag_empresas_atendidas()
    {
        return (string) hashtag_stats_data()['empresas_atendidas_curto'];
    }
}
