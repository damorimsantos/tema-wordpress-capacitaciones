// remover todas as tags style que vêm, pra não dar problema de especificidade:
const tagsStyle = document.querySelectorAll("style");

if (tagsStyle) {
    tagsStyle.forEach((s) => {
        s.parentElement.removeChild(s);
    });
}

// -------------------------------------------------------------------------------

// diminuir a altura dos blocos de espaço:
const blocoEspaco = document.querySelectorAll(".wp-block-spacer");

if (blocoEspaco) {
    blocoEspaco.forEach((e) => {
        const altura = e.clientHeight;
        e.style.height = altura / 1.5 + "px";
    });
}

// -------------------------------------------------------------------------------

// aplicar estilos no elemento pai do elemento pai dos links de último post e próximo post:
const ultimoPost = document.querySelector(".post-navigation-link-previous");

if (ultimoPost) {
    const div = ultimoPost.parentElement.parentElement;

    div.style.display = "flex";
    div.style.justifyContent = "space-between";
    div.style.gap = "1.6rem";
}

// -------------------------------------------------------------------------------

// criar div só pro nome e descrição do autor do post, pra conseguir colocar os dois juntos do lado da foto:
const caixaAutor = document.querySelector(".saboxplugin-tab");
const nomeAutor = document.querySelector(".saboxplugin-authorname");
const autorDescricao = document.querySelector(".saboxplugin-desc");

const divNomeDescricao = document.createElement("div");

if (caixaAutor) {
    divNomeDescricao.appendChild(nomeAutor);
    divNomeDescricao.appendChild(autorDescricao);
    divNomeDescricao.classList.add("div-nome-descricao");

    caixaAutor.appendChild(divNomeDescricao);
}

// -------------------------------------------------------------------------------

// remover todas as tags style que vêm, pra não dar problema de especificidade:
// const tagsStyle = document.querySelectorAll("style");

// if (tagsStyle) {
//     tagsStyle.forEach((s) => {
//         s.parentElement.removeChild(s);
//     });
// }

// -------------------------------------------------------------------------------

// tirar o iframe de dentro da tag noscript:
// const figureIframe = document.querySelectorAll(".wp-block-embed-youtube");

// if (figureIframe) {
//     figureIframe.forEach((fi) => {
//         const divIframe = fi.querySelector(".wp-block-embed__wrapper");
//         const noscript = fi.querySelector("noscript");

//         if (divIframe && noscript) {
//             const parser = new DOMParser();
//             const iframeContent = parser.parseFromString(
//                 noscript.textContent,
//                 "text/html"
//             );
//             const iframeElement = iframeContent.querySelector("iframe");
//             iframeElement.src = iframeElement.src + "?feature=oembed";

//             divIframe.appendChild(iframeElement);

//             divIframe.removeChild(noscript);

//             const divExtra = fi.querySelector(".rll-youtube-player");
//             if (divExtra) {
//                 divExtra.parentElement.removeChild(divExtra);
//             }
//         }
//     });
// }

// -------------------------------------------------------------------------------

// mudar os estilos dos blocos de código antigos:
const blocoCodigo = document.querySelectorAll(".wp-block-code.has-background");

if (blocoCodigo) {
    blocoCodigo.forEach((b) => {
        if (b.style.backgroundColor) {
            b.style.removeProperty("background-color");
        }
        // b.style.backgroundColor = "transparent";
        // b.style.border = "solid 1px #999";
        // b.style.borderRadius = "0.5rem";
        // b.style.padding = "2rem";
        // b.style.marginBottom = "2rem";
    });
}

// -------------------------------------------------------------------------------

// banner curso:

const pathname = window.location.pathname;
const slug = pathname
    .split("/")
    .filter((segment) => segment)
    .pop();
// console.log(slug);

const dataHoje = new Date();
const mesAtual = dataHoje.getMonth() + 1;
// const diaAtual = dataHoje.getDate();

const year = new Date().getFullYear();
const abrAno = year % 100;

const meses = {
    1: "jan",
    2: "fev",
    3: "mar",
    4: "abr",
    5: "mai",
    6: "jun",
    7: "jul",
    8: "ago",
    9: "set",
    10: "out",
    11: "nov",
    12: "dez",
};

let abrMes = "";

for (mes in meses) {
    if (mesAtual == mes) {
        abrMes = meses[mes];
    }
}

const cursosObj = {
    "Inteligência Artificial": {
        curso: "ia",
        categoria: "treinamento",
        banner: '<div class="cursos" id="ia"><div class="cursos__item cursos__item--ia"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/ia.svg" alt="Ícone Inteligência Artificial"><span class="cursos__nome"><b>Inteligência Artificial</b>Impressionador</span></div><p class="cursos__texto cursos__texto--ia"><b>Você vai aprender de forma prática a usar as principais ferramentas de Inteligência Artificial que estão revolucionando o Mercado de Trabalho, </b>para se destacar em qualquer empresa que use as ferramentas dessa revolução. Independente da sua área, aqui você vai aprender como usar a Inteligência Artificial na sua realidade para se destacar.</p><a href="https://www.hashtagtreinamentos.com/curso-ia" target="_blank" class="botao url-curso-lancamento--ia"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--ia" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ia.png" alt="Fundo azul e branco"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ia.png" alt="Três imagens de aulas do curso de Inteligência Artificial"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },

    Inglês: {
        curso: "ing",
        categoria: "idioma",
        banner: '<div class="cursos" id="ingles"><div class="cursos__item cursos__item--ingles"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/ingles.svg" alt="Ícone Inglês"/><span class="cursos__nome"><b>Inglês</b>Impressionador</span></div><p class="cursos__texto cursos__texto--ingles"><b>O Programa Online de Inglês verdadeiramente completo que vai te ensinar tudo que você precisa saber pra ir do Zero à Fluência</b> - independente do seu nível atual. Tudo isso com centenas de aulas completas, centenas de exercícios, material didático, aulas de conversação individuais e em grupo, e muito mais.</p><a href="https://www.hashtagtreinamentos.com/curso-ingles" target="_blank" class="botao url-curso-lancamento--ing" ><span>Começar agora</span> <span> <img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"/> </span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--ingles" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ingles.png" alt="Bandeira dos EUA usada como fundo"/><img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ingles.png" alt="Três imagens de aulas do curso de Inglês"/></div></div></div>',
    },

    Python: {
        curso: "py",
        categoria: "programacao",
        banner: '<div class="cursos" id="python"><div class="cursos__item cursos__item--python"><div class="cursos__coluna cursos__coluna--python"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/python.svg" alt="Ícone Python"><span class="cursos__nome"><b>Python</b>Impressionador</span></div><p class="cursos__texto cursos__texto--python"><b class="cursos__realce">Você vai aprender a linguagem de Programação que mais cresce no Mundo para fazer automações incríveis, </b>desenvolver sites, fazer análises de dados, trabalhar com Ciência de Dados, Inteligência Artificial, mesmo que você nunca tenha tido nenhum contato com Programação na vida.</p><a href="https://www.hashtagtreinamentos.com/curso-python" target="_blank" class="botao url-curso-lancamento--py"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--python" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-python.png" alt="Ícone do Python usado como fundo"> <img loading="lazy" class="cursos__telas cursos__telas--maior" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-python.png" alt="Três imagens de aulas do curso de Python"></div><img loading="lazy" class="cursos__luz cursos__luz--python" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },

    "Power BI": {
        curso: "pbi",
        categoria: "treinamento",
        banner: '<div class="cursos" id="powerbi"><div class="cursos__item cursos__item--powerbi"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/powerbi.svg" alt="Ícone Power BI"><span class="cursos__nome"><b>Power BI</b>Impressionador</span></div><p class="cursos__texto cursos__texto--powerbi"><b>Como dominar a ferramenta que mais cresce e forma profissionais disputados no Mercado de Trabalho, </b>com a criação de Relatórios e Dashboards que impressionam e ajudam na tomada de decisão.</p><a href="https://www.hashtagtreinamentos.com/curso-power-bi" target="_blank" class="botao url-curso-lancamento--pbi"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--powerbi" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-powerbi.png" alt="Ícone do Power BI usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-powerbi.png" alt="Três imagens de aulas do curso de Power BI"></div></div></div>',
    },

    Excel: {
        curso: "ex",
        categoria: "treinamento",
        banner: '<div class="cursos" id="excel"><div class="cursos__item cursos__item--excel"><div class="cursos__coluna"><div class="cursos__icone-nome"><img class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/excel.svg" alt="Ícone Excel"><span class="cursos__nome"><b>Excel</b>Impressionador</span></div><p class="cursos__texto cursos__texto--excel">Tudo que você precisa saber, do Básico ao Avançado, pra dominar a ferramenta mais importante do Mercado de Trabalho. <b>Aprenda as principais ferramentas, funções e recursos do Excel para deixar qualquer planilha mais chamativa e eficiente.</b></p><a href="https://www.hashtagtreinamentos.com/curso-de-excel-online" target="_blank" class="botao url-curso-lancamento--ex"><span>Começar agora</span><span><img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img class="cursos__fundo cursos__fundo--excel" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-excel.png" alt="Ícone do Excel usado como fundo"> <img class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-excel.png" alt="Três imagens de aulas do curso de Excel"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },

    "Ciência de Dados": {
        curso: "cd",
        categoria: "programacao",
        banner: '<div class="cursos" id="ciencia-dados"><div class="cursos__item cursos__item--ciencia-dados"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/ciencia-dados.svg" alt="Ícone Ciência de Dados"><span class="cursos__nome"><b>Ciência de Dados</b>Impressionador</span></div><p class="cursos__texto cursos__texto--ciencia-dados">Se você quiser sair do zero até o nível avançado e aprender absolutamente tudo o que você precisa para usar Ciência de Dados para se destacar no Mercado de Trabalho e poder entrar nas carreiras mais promissoras e desejadas nas empresas, esse curso é pra você.</p><a href="https://www.hashtagtreinamentos.com/curso-ciencia-de-dados" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--ciencia-dados-1" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ciencia-dados-1.png" alt="Círculos e ícones usados como fundo"> <img loading="lazy" class="cursos__fundo cursos__fundo--ciencia-dados-2" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ciencia-dados-2.png" alt="Luzes usadas como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ciencia-dados.png" alt="Três imagens de aulas do curso de Ciência de Dados"></div></div></div>',
    },

    JavaScript: {
        curso: "js",
        categoria: "programacao",
        banner: '<div class="cursos" id="javascript"><div class="cursos__item cursos__item--javascript"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/javascript.svg" alt="Ícone JavaScript"><span class="cursos__nome"><b>JavaScript</b>Impressionador</span></div><p class="cursos__texto cursos__texto--javascript"><b>Como usar JavaScript em qualquer empresa e qualquer área,</b> com exemplos totalmente aplicados à realidade do Mercado de Trabalho, seja para se tornar um Desenvolvedor Front End, Backend, Full Stack ou Mobile.</p><a href="https://www.hashtagtreinamentos.com/curso-javascript" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--javascript" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-javascript.png" alt="Ícone do JavaScript usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-javascript.png" alt="Três imagens de aulas do curso de JavaScript"></div></div></div>',
    },

    VBA: {
        curso: "vba",
        categoria: "treinamento",
        banner: '<div class="cursos" id="vba"><div class="cursos__item cursos__item--vba"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/vba.svg" alt="Ícone VBA"><span class="cursos__nome"><b>VBA</b>Impressionador</span></div><p class="cursos__texto cursos__texto--vba"><b>Como automatizar praticamente qualquer tarefa repetitiva que você faça dentro do Excel.</b>Aprenda a criar integrações do Excel com o PowerPoint, Word, Outlook e muito mais. Aprenda a criar automações para resolver tudo com apenas um clique em um botão. Tudo isso com uma única linguagem que junta todos esses programas.</p><a href="https://www.hashtagtreinamentos.com/curso-vba-excel" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--vba" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-vba.png" alt="Ícone do VBA usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-vba.png" alt="Três imagens de aulas do curso de VBA"></div></div></div>',
    },

    SQL: {
        curso: "sql",
        categoria: "programacao",
        banner: '<div class="cursos" id="sql"><div class="cursos__item cursos__item--sql"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/sql.svg" alt="Ícone SQL"><span class="cursos__nome"><b>SQL</b>Impressionador</span></div><p class="cursos__texto cursos__texto--sql"><b>Domine a linguagem mais importante do Mundo para quem trabalha com Dados,</b> seja para se destacar na sua empresa atual, para conseguir um diferencial em processos seletivos ou até mesmo para entrar em áreas de dados.</p><a href="https://www.hashtagtreinamentos.com/curso-sql" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--sql" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-sql.png" alt="Ícone do SQL usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-sql.png" alt="Três imagens de aulas do curso de SQL"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },

    "HTML e CSS": {
        curso: "htmlcss",
        categoria: "programacao",
        banner: '<div class="cursos" id="html-css"><div class="cursos__item cursos__item--html-css"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/html.svg" alt="Ícone HTML"><span class="cursos__nome cursos__nome--centralizado"><b>HTML e CSS</b>Impressionador</span><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/css.svg" alt="Ícone CSS"></div><p class="cursos__texto cursos__texto--html-css"><b>Você vai aprender não só os fundamentos básicos, intermediários e avançados de HTML e CSS,</b> como também vai aprender a integrar com os principais frameworks. Além disso, você vai sair do curso com um portfólio de projetos completo!</p><a href="https://www.hashtagtreinamentos.com/curso-html-css" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--html-css" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-html-css.png" alt="Ícones do HTML e do CSS usados como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-html-css.png" alt="Três imagens de aulas do curso de HTML e CSS"></div></div></div>',
    },

    "Power Apps": {
        curso: "powerapps",
        categoria: "treinamento",
        banner: '<div class="cursos" id="power-apps"><div class="cursos__item cursos__item--power-apps"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/power-apps.svg" alt="Ícone Power Apps"><span class="cursos__nome"><b>Power Apps</b>Impressionador</span></div><p class="cursos__texto cursos__texto--power-apps"><b>Como criar aplicativos sem precisar saber programar.</b> A ferramenta que a Microsoft criou e já foi implementada em milhares de empresas, que você pode usar pra criar aplicativo de cadastro de produtos, pra registro de vendas, preenchimento de formulários, e muito mais.</p><a href="https://www.hashtagtreinamentos.com/curso-de-power-apps" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--power-apps" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-power-apps.png" alt="Imagem rosa e ícones do Power Apps usados como fundo"> <img loading="lazy" class="cursos__telas cursos__telas--maior" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-power-apps.png" alt="Três imagens de aulas do curso de Power Apps"></div></div></div>',
    },

    PowerPoint: {
        curso: "ppt",
        categoria: "treinamento",
        banner: '<div class="cursos" id="powerpoint"><div class="cursos__item cursos__item--powerpoint"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/powerpoint.svg" alt="Ícone PowerPoint"><span class="cursos__nome"><b>PowerPoint</b>Impressionador</span></div><p class="cursos__texto cursos__texto--powerpoint"><b>Você vai aprender a Dominar a Arte da Apresentação para ser reconhecido e receber as Melhores Oportunidades no Mercado de Trabalho.</b> Você vai aprender não "só" a montar uma apresentação de impacto, mas também todas as técnicas de Persuasão, Linguagem Corporal, Como perder a timidez, e como IMPRESSIONAR em qualquer apresentação (formal ou informal).</p><a href="https://www.hashtagtreinamentos.com/curso-powerpoint" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--powerpoint" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ppt.png" alt="Ícone do PowerPoint usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ppt.png" alt="Três imagens de aulas do curso de PowerPoint"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },

    "Power Automate": {
        curso: "pa",
        categoria: "treinamento",
        banner: '<div class="cursos" id="power-automate"><div class="cursos__item cursos__item--power-automate"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/power-automate.svg" alt="Ícone Power Automate"><span class="cursos__nome"><b>Power Automate</b>Impressionador</span></div><p class="cursos__texto cursos__texto--power-automate"><b>Como automatizar tarefas sem precisar saber programar.</b> Domine a ferramenta da Microsoft que já está sendo implementada em milhares de empresas que permite automatizar tarefas em praticamente qualquer ferramenta, como Power BI, Google Drive, Gmail, WhatsApp, SQL, Trello, Google Sheets, Excel, Teams, Google Forms, e muito mais.</p><a href="https://www.hashtagtreinamentos.com/curso-power-automate" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--power-automate" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-power-automate.png" alt="Ícone do Power Automate usado como fundo"> <img loading="lazy" class="cursos__telas cursos__telas--maior" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-power-automate.png" alt="Três imagens de aulas do curso de Power Automate"></div></div></div>',
    },
    "Análise de Dados": {
        curso: "ad",
        categoria: "treinamento",
        banner: '<div class="cursos" id="analista-dados"><div class="cursos__item cursos__item--analista-dados"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/analista-dados.svg" alt="Ícone Análise de Dados"/><span class="cursos__nome"><b>Análise de Dados</b>Impressionador</span></div><p class="cursos__texto cursos__texto--analista-dados"><b>Essa é uma trilha de especialização que vai te tornar um verdadeiro analista de dados completo,</b> dominando todas as principais ferramentas do Mercado, construindo projetos práticos e exercícios aplicados à realidade das empresas. Tudo o que você precisa para se tornar um Analista de Dados de referência em um único lugar.</p><a href="https://www.hashtagtreinamentos.com/curso-analise-dados" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"/> </span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--analista-dados" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-analista-dados.png" alt="Fundo azul marinho e branco"/><img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-analista-dados.png" alt="Três imagens de aulas da trilha Análise de Dados"/></div></div></div>',
    },
};

const categoriaEl = document.querySelector(".post-categories a");
console.log(categoriaEl);

const containerConteudo = document.querySelector(".container-conteudo");
const blocoSumario = document.querySelector(".wp-block-rank-math-toc-block");

const h2Elements = containerConteudo.querySelectorAll("h2");

function criarParametrosUrl(chave) {
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = cursosObj[chave]["banner"];
    console.log(tempDiv);
    const newElement = tempDiv.firstElementChild;

    const botaoBanner = newElement.querySelector(".botao");

    const origemUrl = `origemurl=hashtag_site_org_blog_banner_${slug}`;
    const utmSource = "utm_source=site-org";
    const utmMedium = "utm_medium=blog-banner";
    const utmCampaign = `utm_campaign=${cursosObj[chave]["categoria"]}`;
    const utmContent = `utm_content=${slug}`;
    let conversion = "";

    // se não tiver cursosObj[chave]["curso"] no dictTabelaLancamentos, faz o conversion do perpetuo

    if (cursosObj[chave]["curso"] in dictTabelaLancamentos) {
        conversion = `conversion=${criarConversionLancamentoForm(
            cursosObj[chave]["curso"]
        )}`;
    } else {
        conversion = `conversion=${criarConversionPerpetuoForm(
            cursosObj[chave]["curso"]
        )}`;
    }

    botaoBanner.href += `?${origemUrl}&${utmSource}&${utmMedium}&${utmCampaign}&${utmContent}&${conversion}`;

    console.log(botaoBanner);

    if (blocoSumario) {
        blocoSumario.parentElement.insertBefore(newElement, blocoSumario);
    } else {
        if (h2Elements) {
            console.log(h2Elements[0]);
            h2Elements[0].parentElement.insertBefore(newElement, h2Elements[0]);
        }
    }
}

if (categoriaEl) {
    if (
        categoriaEl.innerText == "Excel Básico" ||
        categoriaEl.innerText == "Excel Intermediário" ||
        categoriaEl.innerText == "Excel Avançado" ||
        categoriaEl.innerText == "Modelos de Planilhas" ||
        categoriaEl.innerText == "Uncategorized"
    ) {
        criarParametrosUrl("Excel");
    } else {
        for (let chave in cursosObj) {
            if (chave == categoriaEl.innerText) {
                criarParametrosUrl(chave);

                break;
            }
        }
    }
}

// -------------------------------------------------------------------
// substituir o formulário

// const divForm = document.querySelector("div[class^='_form_']");
// if (divForm) {
//     const classeForm = divForm.className.match(/_form_(\d+)/);
//     if (classeForm) {
//         const idForm = classeForm[1];
//     }
// }

// const formAntigo = document.querySelector("form");

// const formNovo = `<form
//       method="POST"
//       action="https://hashtagtreinamentos.activehosted.com/proc.php"
//       id="_form_${idForm}_"
//       class="form"
//       novalidate
//     >
//       <!-- Inputs obrigatórios dos formulários do activecampaign -->
//       <input type="hidden" name="u" value="${idForm}" />
//       <input type="hidden" name="f" value="${idForm}" />
//       <input type="hidden" name="act" value="sub" />

//       <div class="form-inputs">

//         <div class="form-campo">
//           <input
//             type="text"
//             id="email"
//             name="email"
//             placeholder="Seu melhor e-mail"
//             required
//           />
//           <small></small>
//         </div>

//         <!-- OrigemURL -->
//         <input type="hidden" name="field[6]" value="" />

//         <!-- OrigemRef -->
//         <input type="hidden" name="field[10]" value="" />

//         <!-- FonteTemp -->
//         <input type="hidden" name="field[62]" value="" />

//         <!-- PerformanceMax -->
//         <input type="hidden" name="field[133]" value="" />

//         <!-- Conversion -->
//         <input type="hidden" name="field[134]" value="" />

//         <!-- utm_source -->
//         <input type="hidden" name="field[135]" value="" />

//         <!-- utm_medium -->
//         <input type="hidden" name="field[136]" value="" />

//         <!-- utm_term -->
//         <input type="hidden" name="field[137]" value="" />

//         <!-- utm_content -->
//         <input type="hidden" name="field[138]" value="" />

//         <!-- utm_campaign -->
//         <input type="hidden" name="field[139]" value="" />
//       </div>

//       <button class="btn btn--hero" id="_form_${idForm}_submit" type="submit">
//         Enviar
//       </button>
//     </form>`;

// divForm.insertAdjacentHTML("afterend", formNovo);
// divForm.remove();

// -------------------------------------------------------------------
// adicionar o form e os textos de cima e de baixo numa div

function getNextParagraph(el) {
    let next = el.nextElementSibling;
    while (next && next.tagName.toLowerCase() !== "p") {
        next = next.nextElementSibling;
    }
    return next;
}

const divForm = document.querySelector("div[class^='_form_']");
if (divForm) {
    const paragraphAbove = divForm.previousElementSibling;
    const paragraphBelow = getNextParagraph(divForm);

    const newDiv = document.createElement("div");
    newDiv.classList.add("new-form-container");

    divForm.parentNode.insertBefore(newDiv, divForm);

    if (paragraphAbove) newDiv.appendChild(paragraphAbove);
    newDiv.appendChild(divForm);
    if (paragraphBelow) newDiv.appendChild(paragraphBelow);
}
