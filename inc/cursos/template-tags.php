<?php

// ===========================================================================
// Wrappers globais — API nova (preferir em código novo)
// ===========================================================================

function hashtag_get_course_catalog()
{
    return Hashtag_Course_Catalog::get_catalog();
}

function hashtag_get_course($slug)
{
    return Hashtag_Course_Catalog::get_course($slug);
}

function hashtag_get_ranked_courses($include_outros = true)
{
    return Hashtag_Course_Catalog::get_ranked_courses($include_outros);
}

function hashtag_get_ranked_courses_top($n, $include_outros = true)
{
    return Hashtag_Course_Catalog::get_ranked_courses_top($n, $include_outros);
}

function hashtag_get_courses_by_category($categoria)
{
    return Hashtag_Course_Catalog::get_courses_by_category($categoria);
}

function hashtag_get_grouped_courses_for_comunidade()
{
    return Hashtag_Course_Catalog::get_grouped_courses_for_comunidade();
}

function hashtag_build_course_url($slug, $context, array $extra = [])
{
    return Hashtag_Course_Catalog::build_course_url($slug, $context, $extra);
}

function hashtag_render_course_card($slug, $context = 'home-cursos-cards')
{
    return Hashtag_Course_Catalog::render_course_card($slug, $context);
}

function hashtag_render_course_cards_track(array $courses, $context = 'home-cursos-cards')
{
    return Hashtag_Course_Catalog::render_course_cards_track($courses, $context);
}

function hashtag_render_grouped_course_cards($context = 'comunidade-cards')
{
    return Hashtag_Course_Catalog::render_grouped_course_cards($context);
}

function hashtag_render_scroller_for_courses(array $courses, $context = 'home-scroller')
{
    return Hashtag_Course_Catalog::render_scroller_for_courses($courses, $context);
}

// ===========================================================================
// Wrappers legacy (manter para templates ainda não migrados)
// ===========================================================================

function hashtag_get_course_entries_by_order($order_key, $type)
{
    return Hashtag_Course_Catalog::get_entries_by_order($order_key, $type);
}

function hashtag_render_course_scroller_items(
    $order_key,
    $utm_medium = '',
    $utm_content = ''
) {
    return Hashtag_Course_Catalog::render_scroller_items(
        $order_key,
        $utm_medium,
        $utm_content
    );
}

function hashtag_get_home_scroller_items()
{
    return Hashtag_Course_Catalog::get_home_scroller_items();
}

function hashtag_render_home_scroller_items($utm_medium = '', $utm_content = '')
{
    return Hashtag_Course_Catalog::render_home_scroller_items(
        $utm_medium,
        $utm_content
    );
}

function hashtag_render_home_scroller_items_responsive(
    $utm_medium = '',
    $utm_content = ''
) {
    return Hashtag_Course_Catalog::render_home_scroller_items_responsive(
        $utm_medium,
        $utm_content
    );
}

function hashtag_get_home_course_cards()
{
    return Hashtag_Course_Catalog::get_home_course_cards();
}

function hashtag_render_home_course_cards()
{
    return Hashtag_Course_Catalog::render_home_course_cards();
}
