const initPostBlog = () => {
  // Referencias base usadas ao longo da pagina do post.
  const runtimeStyleId = "post-blog-runtime-styles";
  const content = document.querySelector(".post__text");
  const toc = document.querySelector("#post-toc");
  const tocWrapper = document.querySelector("[data-post-toc]");
  const layout = document.querySelector(".post__layout");
  const categoryLink = document.querySelector(".post__category");
  const courseCategoryAliases = {
    "inteligencia artificial": "Inteligência Artificial",
    ia: "Inteligência Artificial",
    ingles: "Inglês",
    python: "Python",
    "power bi": "Power BI",
    powerbi: "Power BI",
    "power-bi": "Power BI",
    excel: "Excel",
    "excel basico": "Excel",
    "excel intermediario": "Excel",
    "excel avancado": "Excel",
    "modelos de planilhas": "Excel",
    uncategorized: "Comunidade Impressionadora",
    "sem categoria": "Comunidade Impressionadora",
    "dicas da hashtag": "Comunidade Impressionadora",
    "treinamentos corporativos hashtag": "Comunidade Impressionadora",
    negocios: "Comunidade Impressionadora",
    r: "Comunidade Impressionadora",
    "no code": "Comunidade Impressionadora",
    "no-code": "Comunidade Impressionadora",
    "ciencia de dados": "Ciência de Dados",
    "ciencia-dados": "Ciência de Dados",
    javascript: "JavaScript",
    vba: "VBA",
    sql: "SQL",
    "html e css": "HTML e CSS",
    "html-css": "HTML e CSS",
    "power apps": "Power Apps",
    "power-apps": "Power Apps",
    powerpoint: "PowerPoint",
    "power automate": "Power Automate",
    "power-automate": "Power Automate",
    "analise de dados": "Análise de Dados",
    "analise-dados": "Análise de Dados",
  };

  // Slug atual do post, usado para UTMs e identificacao do banner dinamico.
  const pathname = window.location.pathname;
  const currentPostSlug = pathname
    .split("/")
    .filter((segment) => segment)
    .pop();

  // Catalogo dos banners de curso. Cada chave representa uma categoria do blog
  // e aponta para o HTML do banner original, alem das informacoes de tracking.
  const courseBannerMap = {
    "Inteligência Artificial": {
      curso: "ia",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="ia"><div class="cursos__item cursos__item--ia"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/ia.svg" alt="Ícone Inteligência Artificial"><span class="cursos__nome"><b>Inteligência Artificial</b>Impressionador</span></div><p class="cursos__texto cursos__texto--ia"><b>Você vai aprender de forma prática a usar as principais ferramentas de Inteligência Artificial que estão revolucionando o Mercado de Trabalho, </b>para se destacar em qualquer empresa que use as ferramentas dessa revolução. Independente da sua área, aqui você vai aprender como usar a Inteligência Artificial na sua realidade para se destacar.</p><a href="https://www.hashtagtreinamentos.com/curso-ia" target="_blank" class="botao url-curso-lancamento--ia"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--ia" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ia.png" alt="Fundo azul e branco"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ia.png" alt="Três imagens de aulas do curso de Inteligência Artificial"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },
    Inglês: {
      curso: "ing",
      categoria: "idioma",
      banner:
        '<div class="cursos" id="ingles"><div class="cursos__item cursos__item--ingles"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/ingles.svg" alt="Ícone Inglês"/><span class="cursos__nome"><b>Inglês</b>Impressionador</span></div><p class="cursos__texto cursos__texto--ingles"><b>O Programa Online de Inglês verdadeiramente completo que vai te ensinar tudo que você precisa saber pra ir do Zero à Fluência</b> - independente do seu nível atual. Tudo isso com centenas de aulas completas, centenas de exercícios, material didático, aulas de conversação individuais e em grupo, e muito mais.</p><a href="https://www.hashtagtreinamentos.com/curso-ingles" target="_blank" class="botao url-curso-lancamento--ing" ><span>Começar agora</span> <span> <img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"/> </span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--ingles" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ingles.png" alt="Bandeira dos EUA usada como fundo"/><img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ingles.png" alt="Três imagens de aulas do curso de Inglês"/></div></div></div>',
    },
    Python: {
      curso: "py",
      categoria: "programacao",
      banner:
        '<div class="cursos" id="python"><div class="cursos__item cursos__item--python"><div class="cursos__coluna cursos__coluna--python"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/python.svg" alt="Ícone Python"><span class="cursos__nome"><b>Python</b>Impressionador</span></div><p class="cursos__texto cursos__texto--python"><b class="cursos__realce">Você vai aprender a linguagem de Programação que mais cresce no Mundo para fazer automações incríveis, </b>desenvolver sites, fazer análises de dados, trabalhar com Ciência de Dados, Inteligência Artificial, mesmo que você nunca tenha tido nenhum contato com Programação na vida.</p><a href="https://www.hashtagtreinamentos.com/pg-inscricao-python-impressionador" target="_blank" class="botao url-curso-lancamento--py"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--python" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-python.png" alt="Ícone do Python usado como fundo"> <img loading="lazy" class="cursos__telas cursos__telas--maior" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-python.png" alt="Três imagens de aulas do curso de Python"></div><img loading="lazy" class="cursos__luz cursos__luz--python" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },
    "Power BI": {
      curso: "pbi",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="powerbi"><div class="cursos__item cursos__item--powerbi"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/powerbi.svg" alt="Ícone Power BI"><span class="cursos__nome"><b>Power BI</b>Impressionador</span></div><p class="cursos__texto cursos__texto--powerbi"><b>Como dominar a ferramenta que mais cresce e forma profissionais disputados no Mercado de Trabalho, </b>com a criação de Relatórios e Dashboards que impressionam e ajudam na tomada de decisão.</p><a href="https://www.hashtagtreinamentos.com/curso-power-bi" target="_blank" class="botao url-curso-lancamento--pbi"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--powerbi" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-powerbi.png" alt="Ícone do Power BI usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-powerbi.png" alt="Três imagens de aulas do curso de Power BI"></div></div></div>',
    },
    Excel: {
      curso: "ex",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="excel"><div class="cursos__item cursos__item--excel"><div class="cursos__coluna"><div class="cursos__icone-nome"><img class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/excel.svg" alt="Ícone Excel"><span class="cursos__nome"><b>Excel</b>Impressionador</span></div><p class="cursos__texto cursos__texto--excel">Tudo que você precisa saber, do Básico ao Avançado, pra dominar a ferramenta mais importante do Mercado de Trabalho. <b>Aprenda as principais ferramentas, funções e recursos do Excel para deixar qualquer planilha mais chamativa e eficiente.</b></p><a href="https://www.hashtagtreinamentos.com/curso-de-excel-online" target="_blank" class="botao url-curso-lancamento--ex"><span>Começar agora</span><span><img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img class="cursos__fundo cursos__fundo--excel" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-excel.png" alt="Ícone do Excel usado como fundo"> <img class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-excel.png" alt="Três imagens de aulas do curso de Excel"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },
    "Ciência de Dados": {
      curso: "cd",
      categoria: "programacao",
      banner:
        '<div class="cursos" id="ciencia-dados"><div class="cursos__item cursos__item--ciencia-dados"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/ciencia-dados.svg" alt="Ícone Ciência de Dados"><span class="cursos__nome"><b>Ciência de Dados</b>Impressionador</span></div><p class="cursos__texto cursos__texto--ciencia-dados">Se você quiser sair do zero até o nível avançado e aprender absolutamente tudo o que você precisa para usar Ciência de Dados para se destacar no Mercado de Trabalho e poder entrar nas carreiras mais promissoras e desejadas nas empresas, esse curso é pra você.</p><a href="https://www.hashtagtreinamentos.com/curso-ciencia-de-dados" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--ciencia-dados-1" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ciencia-dados-1.png" alt="Círculos e ícones usados como fundo"> <img loading="lazy" class="cursos__fundo cursos__fundo--ciencia-dados-2" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ciencia-dados-2.png" alt="Luzes usadas como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ciencia-dados.png" alt="Três imagens de aulas do curso de Ciência de Dados"></div></div></div>',
    },
    JavaScript: {
      curso: "js",
      categoria: "programacao",
      banner:
        '<div class="cursos" id="javascript"><div class="cursos__item cursos__item--javascript"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/javascript.svg" alt="Ícone JavaScript"><span class="cursos__nome"><b>JavaScript</b>Impressionador</span></div><p class="cursos__texto cursos__texto--javascript"><b>Como usar JavaScript em qualquer empresa e qualquer área,</b> com exemplos totalmente aplicados à realidade do Mercado de Trabalho, seja para se tornar um Desenvolvedor Front End, Backend, Full Stack ou Mobile.</p><a href="https://www.hashtagtreinamentos.com/curso-javascript" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--javascript" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-javascript.png" alt="Ícone do JavaScript usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-javascript.png" alt="Três imagens de aulas do curso de JavaScript"></div></div></div>',
    },
    VBA: {
      curso: "vba",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="vba"><div class="cursos__item cursos__item--vba"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/vba.svg" alt="Ícone VBA"><span class="cursos__nome"><b>VBA</b>Impressionador</span></div><p class="cursos__texto cursos__texto--vba"><b>Como automatizar praticamente qualquer tarefa repetitiva que você faça dentro do Excel.</b>Aprenda a criar integrações do Excel com o PowerPoint, Word, Outlook e muito mais. Aprenda a criar automações para resolver tudo com apenas um clique em um botão. Tudo isso com uma única linguagem que junta todos esses programas.</p><a href="https://www.hashtagtreinamentos.com/curso-vba-excel" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--vba" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-vba.png" alt="Ícone do VBA usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-vba.png" alt="Três imagens de aulas do curso de VBA"></div></div></div>',
    },
    SQL: {
      curso: "sql",
      categoria: "programacao",
      banner:
        '<div class="cursos" id="sql"><div class="cursos__item cursos__item--sql"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/sql.svg" alt="Ícone SQL"><span class="cursos__nome"><b>SQL</b>Impressionador</span></div><p class="cursos__texto cursos__texto--sql"><b>Domine a linguagem mais importante do Mundo para quem trabalha com Dados,</b> seja para se destacar na sua empresa atual, para conseguir um diferencial em processos seletivos ou até mesmo para entrar em áreas de dados.</p><a href="https://www.hashtagtreinamentos.com/curso-sql" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--sql" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-sql.png" alt="Ícone do SQL usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-sql.png" alt="Três imagens de aulas do curso de SQL"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },
    "HTML e CSS": {
      curso: "htmlcss",
      categoria: "programacao",
      banner:
        '<div class="cursos" id="html-css"><div class="cursos__item cursos__item--html-css"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/html.svg" alt="Ícone HTML"><span class="cursos__nome cursos__nome--centralizado"><b>HTML e CSS</b>Impressionador</span><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/css.svg" alt="Ícone CSS"></div><p class="cursos__texto cursos__texto--html-css"><b>Você vai aprender não só os fundamentos básicos, intermediários e avançados de HTML e CSS,</b> como também vai aprender a integrar com os principais frameworks. Além disso, você vai sair do curso com um portfólio de projetos completo!</p><a href="https://www.hashtagtreinamentos.com/curso-html-css" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--html-css" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-html-css.png" alt="Ícones do HTML e do CSS usados como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-html-css.png" alt="Três imagens de aulas do curso de HTML e CSS"></div></div></div>',
    },
    "Power Apps": {
      curso: "powerapps",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="power-apps"><div class="cursos__item cursos__item--power-apps"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/power-apps.svg" alt="Ícone Power Apps"><span class="cursos__nome"><b>Power Apps</b>Impressionador</span></div><p class="cursos__texto cursos__texto--power-apps"><b>Como criar aplicativos sem precisar saber programar.</b> A ferramenta que a Microsoft criou e já foi implementada em milhares de empresas, que você pode usar pra criar aplicativo de cadastro de produtos, pra registro de vendas, preenchimento de formulários, e muito mais.</p><a href="https://www.hashtagtreinamentos.com/curso-de-power-apps" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--power-apps" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-power-apps.png" alt="Imagem rosa e ícones do Power Apps usados como fundo"> <img loading="lazy" class="cursos__telas cursos__telas--maior" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-power-apps.png" alt="Três imagens de aulas do curso de Power Apps"></div></div></div>',
    },
    PowerPoint: {
      curso: "ppt",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="powerpoint"><div class="cursos__item cursos__item--powerpoint"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/powerpoint.svg" alt="Ícone PowerPoint"><span class="cursos__nome"><b>PowerPoint</b>Impressionador</span></div><p class="cursos__texto cursos__texto--powerpoint"><b>Você vai aprender a Dominar a Arte da Apresentação para ser reconhecido e receber as Melhores Oportunidades no Mercado de Trabalho.</b> Você vai aprender não "só" a montar uma apresentação de impacto, mas também todas as técnicas de Persuasão, Linguagem Corporal, Como perder a timidez, e como IMPRESSIONAR em qualquer apresentação (formal ou informal).</p><a href="https://www.hashtagtreinamentos.com/curso-powerpoint" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--powerpoint" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-ppt.png" alt="Ícone do PowerPoint usado como fundo"> <img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-ppt.png" alt="Três imagens de aulas do curso de PowerPoint"></div><img loading="lazy" class="cursos__luz" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/luz-inteira.png"></div></div>',
    },
    "Power Automate": {
      curso: "pa",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="power-automate"><div class="cursos__item cursos__item--power-automate"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/power-automate.svg" alt="Ícone Power Automate"><span class="cursos__nome"><b>Power Automate</b>Impressionador</span></div><p class="cursos__texto cursos__texto--power-automate"><b>Como automatizar tarefas sem precisar saber programar.</b> Domine a ferramenta da Microsoft que já está sendo implementada em milhares de empresas que permite automatizar tarefas em praticamente qualquer ferramenta, como Power BI, Google Drive, Gmail, WhatsApp, SQL, Trello, Google Sheets, Excel, Teams, Google Forms, e muito mais.</p><a href="https://www.hashtagtreinamentos.com/curso-power-automate" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"></span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--power-automate" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-power-automate.png" alt="Ícone do Power Automate usado como fundo"> <img loading="lazy" class="cursos__telas cursos__telas--maior" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-power-automate.png" alt="Três imagens de aulas do curso de Power Automate"></div></div></div>',
    },
    "Análise de Dados": {
      curso: "ad",
      categoria: "treinamento",
      banner:
        '<div class="cursos" id="analista-dados"><div class="cursos__item cursos__item--analista-dados"><div class="cursos__coluna"><div class="cursos__icone-nome"><img loading="lazy" class="cursos__icone" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/Ícones/analista-dados.svg" alt="Ícone Análise de Dados"/><span class="cursos__nome"><b>Análise de Dados</b>Impressionador</span></div><p class="cursos__texto cursos__texto--analista-dados"><b>Essa é uma trilha de especialização que vai te tornar um verdadeiro analista de dados completo,</b> dominando todas as principais ferramentas do Mercado, construindo projetos práticos e exercícios aplicados à realidade das empresas. Tudo o que você precisa para se tornar um Analista de Dados de referência em um único lugar.</p><a href="https://www.hashtagtreinamentos.com/curso-analise-dados" target="_blank" class="botao"><span>Começar agora</span><span><img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg" alt="Seta para a direita"/> </span></a></div><div class="cursos__placeholder"><img loading="lazy" class="cursos__fundo cursos__fundo--analista-dados" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/fundo-analista-dados.png" alt="Fundo azul marinho e branco"/><img loading="lazy" class="cursos__telas" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Todos-Cursos/telas-analista-dados.png" alt="Três imagens de aulas da trilha Análise de Dados"/></div></div></div>',
    },
  };

  // Fallback de estilos para quando o CSS do post nao entra com a especificidade esperada.
  const injectRuntimeStyles = () => {
    if (!document.body.classList.contains("pg-post")) return;
    if (document.getElementById(runtimeStyleId)) return;

    const style = document.createElement("style");
    style.id = runtimeStyleId;
    style.textContent = `
      body.pg-post,
      body.pg-post .post,
      body.pg-post .post__hero,
      body.pg-post .post .container,
      body.pg-post .post__layout,
      body.pg-post .post__content {
        overflow: visible !important;
      }

      body.pg-post .post__layout {
        display: grid !important;
        grid-template-columns: minmax(0, 84rem) minmax(28rem, 32rem) !important;
        justify-content: space-between !important;
        gap: 1.6rem !important;
        align-items: start !important;
      }

      body.pg-post .post__header,
      body.pg-post .post__title,
      body.pg-post .post__text,
      body.pg-post .post__thumbnail {
        max-width: 88rem !important;
        width: 100% !important;
      }

      body.pg-post .post__title {
        font-size: clamp(2.8rem, 3.2vw, 4.6rem) !important;
        line-height: 1.12 !important;
      }

      body.pg-post .post__aside {
        position: sticky !important;
        top: 10rem !important;
        width: 100% !important;
        align-self: start !important;
        justify-self: end !important;
      }

      body.pg-post .post__toc {
        max-width: 32rem !important;
      }

      body.pg-post .post__toc--sticky {
        position: sticky !important;
        top: 0 !important;
        max-height: calc(100vh - 12rem) !important;
        overflow-y: auto !important;
        overscroll-behavior: contain !important;
        scrollbar-width: none;
        -ms-overflow-style: none;
      }

      body.pg-post .post__toc--sticky::-webkit-scrollbar {
        display: none;
      }

      body.pg-post .post__text .wp-block-latest-posts {
        display: grid !important;
        grid-template-columns: repeat(3, minmax(22rem, 1fr)) !important;
        gap: 2.4rem !important;
        width: 100% !important;
        margin: 4.8rem 0 0 !important;
        padding: 0 !important;
        list-style: none !important;
        align-items: stretch !important;
      }

      body.pg-post .post__text .wp-block-latest-posts li {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        min-width: 0 !important;
        min-height: 100% !important;
        overflow: hidden !important;
        padding: 1rem 1rem 2rem !important;
        border: 1px solid rgba(79, 104, 138, 0.68) !important;
        border-radius: 2rem !important;
        background: linear-gradient(180deg, rgba(26, 35, 48, 0.98), rgba(18, 26, 37, 0.98)) !important;
        box-shadow: 0 1.8rem 4rem rgba(5, 10, 18, 0.16) !important;
      }

      body.pg-post .post__text .wp-block-latest-posts li > * {
        min-width: 0;
        margin-bottom: 0;
      }

      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__featured-image a,
      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__featured-image img {
        display: block;
        width: 100%;
        max-width: 100%;
      }

      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__featured-image img {
        aspect-ratio: 16 / 10;
        border-radius: 1.4rem;
        object-fit: cover;
      }

      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__post-title,
      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__post-excerpt,
      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__post-content,
      body.pg-post .post__text .wp-block-latest-posts .wp-block-latest-posts__post-date {
        white-space: normal !important;
        word-break: normal !important;
        overflow-wrap: anywhere !important;
      }

      body.pg-post .post__text .cursos {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
      }

      body.pg-post .post__text .cursos > .container {
        max-width: none !important;
        padding: 0 !important;
      }

      body.pg-post .post__text .cursos .cursos__item {
        width: 100% !important;
      }

      body.pg-post .post__text pre {
        background: #0b1119 !important;
        color: #e6edf7 !important;
      }

      body.pg-post .post__text pre,
      body.pg-post .post__text pre code,
      body.pg-post .post__text pre code span,
      body.pg-post .post__text .wp-block-code,
      body.pg-post .post__text .wp-block-code code,
      body.pg-post .post__text .wp-block-code span,
      body.pg-post .post__text .enlighter-default,
      body.pg-post .post__text .enlighter-default *,
      body.pg-post .post__text .enlighter,
      body.pg-post .post__text .enlighter *,
      body.pg-post .post__text .enlighter-code,
      body.pg-post .post__text .enlighter-code *,
      body.pg-post .post__text .enlighter-raw,
      body.pg-post .post__text .enlighter-raw *,
      body.pg-post .post__text .hljs,
      body.pg-post .post__text .hljs *,
      body.pg-post .post__text .prism-code,
      body.pg-post .post__text .prism-code *,
      body.pg-post .post__text .syntaxhighlighter,
      body.pg-post .post__text .syntaxhighlighter * {
        color: #e6edf7 !important;
      }

      body.pg-post .post__text pre code,
      body.pg-post .post__text .wp-block-code code,
      body.pg-post .post__text .enlighter-default,
      body.pg-post .post__text .enlighter,
      body.pg-post .post__text .enlighter-code,
      body.pg-post .post__text .enlighter-raw,
      body.pg-post .post__text .hljs,
      body.pg-post .post__text .prism-code,
      body.pg-post .post__text .syntaxhighlighter {
        background: transparent !important;
      }

      body.pg-post .post__text .enlighter-default {
        overflow: hidden !important;
        border: 1px solid rgba(97, 121, 153, 0.24) !important;
        border-radius: 1.8rem !important;
        background: #0b1119 !important;
        box-shadow: none !important;
      }

      body.pg-post .post__text .enlighter-default .enlighter-toolbar {
        background: rgba(18, 26, 37, 0.96) !important;
        border-color: rgba(97, 121, 153, 0.2) !important;
      }

      body.pg-post .post__text .enlighter-default .enlighter-btn {
        background: transparent !important;
        color: #9fb2cc !important;
      }

      body.pg-post .post__text .enlighter-default .enlighter-btn:hover {
        background: rgba(109, 165, 255, 0.12) !important;
        color: #f5f7fb !important;
      }

      body.pg-post .post__text .enlighter-default .enlighter-tooltip {
        background: #16202c !important;
        color: #f5f7fb !important;
        border: 1px solid rgba(97, 121, 153, 0.22) !important;
      }

      body.pg-post .post__text .enlighter-default .enlighter-linenumbers,
      body.pg-post .post__text .enlighter-default .enlighter-special {
        color: #6f8198 !important;
        background: rgba(255, 255, 255, 0.03) !important;
      }

      body.pg-post .post__text .new-form-container [class*="_form_"] {
        width: 100% !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"]._form,
      body.pg-post .post__text form[id^="form_"] {
        width: 100% !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        border-radius: 0 !important;
        background: transparent !important;
        color: #d7e0ec !important;
        box-shadow: none !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] div,
      body.pg-post .post__text .new-form-container [id^="_form_"] ._form-content,
      body.pg-post .post__text .new-form-container [id^="_form_"] ._form-inner,
      body.pg-post .post__text form[id^="form_"] ._form_element,
      body.pg-post .post__text form[id^="form_"] ._field-wrapper,
      body.pg-post .post__text form[id^="form_"] ._button-wrapper {
        background: transparent !important;
        box-shadow: none !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] ._button-wrapper,
      body.pg-post .post__text form[id^="form_"] ._button-wrapper {
        align-self: end !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] ._form-label,
      body.pg-post .post__text .new-form-container [id^="_form_"] label._form-label,
      body.pg-post .post__text .new-form-container [id^="_form_"] ._form_element > label,
      body.pg-post .post__text form[id^="form_"] ._form-label,
      body.pg-post .post__text form[id^="form_"] label._form-label,
      body.pg-post .post__text form[id^="form_"] ._form_element > label {
        display: none !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] ._form-content,
      body.pg-post .post__text form[id^="form_"] ._form-content {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) 24rem !important;
        gap: 1.6rem !important;
        align-items: end !important;
        align-content: start !important;
        min-height: 0 !important;
        height: auto !important;
        padding: 0 !important;
      }

      body.pg-post .post__text [class^="container_form_"],
      body.pg-post .post__text [class*=" container_form_"],
      body.pg-post .post__text .new-form-container {
        margin: 4rem 0 !important;
        padding: 3.2rem !important;
        border: 1px solid rgba(97, 121, 153, 0.25) !important;
        border-radius: 2.4rem !important;
        background: linear-gradient(180deg, rgba(29, 39, 53, 0.95), rgba(20, 28, 39, 0.95)) !important;
        box-shadow: none !important;
      }

      body.pg-post .post__text [class^="texto_form_"],
      body.pg-post .post__text [class*=" texto_form_"] {
        margin: 0 0 2rem !important;
        color: #f4f7fb !important;
        font-size: 1.8rem !important;
        font-weight: 700 !important;
        line-height: 1.45 !important;
        text-transform: none !important;
        text-align: center !important;
      }

      body.pg-post .post__text .post__legacy-form-container .post__embedded-form .is-hidden-field,
      body.pg-post .post__text form[id^="form_"] ._clear-element,
      body.pg-post .post__text form[id^="form_"] > br {
        display: none !important;
      }

      body.pg-post .post__text .post__legacy-form-container .post__embedded-form .is-visible-field,
      body.pg-post .post__text .post__legacy-form-container .post__embedded-form .is-submit-field,
      body.pg-post .post__text .new-form-container .post__embedded-form .is-visible-field,
      body.pg-post .post__text .new-form-container .post__embedded-form .is-submit-field {
        width: 100% !important;
        margin: 0 !important;
      }

      body.pg-post .post__text .post__legacy-form-container .post__embedded-form .is-visible-field,
      body.pg-post .post__text .new-form-container .post__embedded-form .is-visible-field {
        padding: 0 !important;
        border: 0 !important;
        border-radius: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] input[type="text"],
      body.pg-post .post__text .new-form-container [id^="_form_"] input[type="email"],
      body.pg-post .post__text form[id^="form_"] input[type="text"],
      body.pg-post .post__text form[id^="form_"] input[type="email"],
      body.pg-post .post__text form[id^="form_"] textarea {
        width: 100% !important;
        min-height: 6.4rem !important;
        padding: 0 2rem !important;
        border: 1px solid rgba(124, 142, 170, 0.38) !important;
        border-radius: 1.2rem !important;
        background: rgba(255, 255, 255, 0.96) !important;
        color: #111827 !important;
        font-size: 1.8rem !important;
        line-height: 1.2 !important;
        box-shadow: none !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] input::placeholder,
      body.pg-post .post__text form[id^="form_"] input::placeholder,
      body.pg-post .post__text form[id^="form_"] textarea::placeholder {
        color: #66758d !important;
        opacity: 1 !important;
      }

      body.pg-post .post__text .new-form-container [id^="_form_"] ._submit,
      body.pg-post .post__text form[id^="form_"] ._submit {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        min-height: 6.4rem !important;
        padding: 0 2.4rem !important;
        border: 0 !important;
        border-radius: 1.2rem !important;
        background: linear-gradient(135deg, #ff7a18 0%, #ff6b00 100%) !important;
        color: #ffffff !important;
        font-size: 1.8rem !important;
        font-weight: 700 !important;
        line-height: 1 !important;
        box-shadow: 0 1.2rem 3rem rgba(255, 107, 0, 0.18) !important;
      }

      body.pg-post .post__text form[id^="form_"] ._submit br {
        display: none !important;
      }

      body.pg-post .post__text .new-form-container > p,
      body.pg-post .post__text .new-form-container .has-text-align-center,
      body.pg-post .post__text form[id^="form_"] ._form-thank-you {
        margin: 2.4rem auto 0 !important;
        max-width: 96rem !important;
        color: #d7e0ec !important;
        font-size: 1.2rem !important;
        line-height: 1.7 !important;
        text-align: center !important;
      }

      body.pg-post .post__sales-banner {
        margin-top: 4rem !important;
        padding: 3.2rem !important;
        border: 1px solid rgba(97, 121, 153, 0.22) !important;
        border-radius: 2.4rem !important;
        background: linear-gradient(135deg, rgba(20, 30, 43, 0.98), rgba(15, 24, 36, 0.98)) !important;
        box-shadow: 0 2rem 5rem rgba(5, 10, 18, 0.22) !important;
      }

      body.pg-post .post__sales-banner-inner {
        display: grid !important;
        grid-template-columns: minmax(0, 1.5fr) minmax(24rem, 32rem) !important;
        gap: 2.4rem !important;
        align-items: center !important;
      }

      body.pg-post .post__sales-banner-title,
      body.pg-post .post__sales-banner-text {
        text-align: left !important;
      }

      body.pg-post .post__sales-banner-cta {
        display: flex !important;
        justify-content: flex-end !important;
      }

      body.pg-post .post__sales-banner-link {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 1rem !important;
        width: 100% !important;
        min-height: 6rem !important;
        padding: 0 2.4rem !important;
        border-radius: 1.6rem !important;
        background: linear-gradient(135deg, #ff7a18 0%, #ff6b00 100%) !important;
        color: #ffffff !important;
        font-size: 1.8rem !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        box-shadow: 0 1.6rem 4rem rgba(255, 107, 0, 0.2) !important;
      }

      @media (max-width: 1100px) {
        body.pg-post .post__text .wp-block-latest-posts {
          grid-template-columns: repeat(2, minmax(22rem, 1fr)) !important;
        }
      }

      @media (max-width: 900px) {
        body.pg-post .post__layout {
          grid-template-columns: 1fr !important;
          gap: 4rem !important;
        }

        body.pg-post .post__aside {
          display: none !important;
        }

        body.pg-post .post__sales-banner-inner {
          grid-template-columns: 1fr !important;
        }
      }

      @media (max-width: 767px) {
        body.pg-post .post .container {
          padding: 0 2rem !important;
        }

        body.pg-post .post__text .wp-block-latest-posts,
        body.pg-post .post__text .new-form-container [id^="_form_"] ._form-content,
        body.pg-post .post__text form[id^="form_"] ._form-content {
          grid-template-columns: 1fr !important;
        }

        body.pg-post .post__text [class^="container_form_"],
        body.pg-post .post__text [class*=" container_form_"],
        body.pg-post .post__text .new-form-container,
        body.pg-post .post__sales-banner {
          padding: 2.4rem 1.8rem !important;
        }
      }
    `;

    document.head.appendChild(style);
  };

  // Detecta se o layout principal do post ainda nao recebeu os estilos esperados.
  const shouldInjectRuntimeStyles = () => {
    if (!document.body.classList.contains("pg-post") || !layout) return false;

    const computedLayout = window.getComputedStyle(layout);
    const tocCard = document.querySelector(".post__toc");
    const computedToc = tocCard ? window.getComputedStyle(tocCard) : null;

    return computedLayout.display !== "grid" || !computedToc || computedToc.position === "static";
  };

  // Gera ids amigaveis para sumario e ancora dos headings.
  const slugify = (text) =>
    text
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/(^-|-$)/g, "");

  // Normaliza labels para comparacoes de categoria sem depender de acentos ou caixa.
  const normalizeLabel = (value = "") =>
    value
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .trim();

  // Extrai o slug da categoria atual a partir do link exibido no topo do post.
  const getCategorySlugFromLink = () => {
    if (!categoryLink) return "";

    const href = categoryLink.getAttribute("href") || "";
    if (!href) return "";

    try {
      const url = new URL(href, window.location.origin);
      return url.pathname
        .split("/")
        .filter((segment) => segment)
        .pop()
        ?.toLowerCase() || "";
    } catch (error) {
      return href
        .split("/")
        .filter((segment) => segment)
        .pop()
        ?.toLowerCase() || "";
    }
  };

  // Mapeia a categoria atual para o slug usado pelo componente original de banners.
  const resolveCourseBannerKey = (categoryName) => {
    const normalizedCategory = normalizeLabel(categoryName);
    const categorySlug = normalizeLabel(getCategorySlugFromLink().replace(/-/g, " "));
    const componentBannerAliases = {
      "inteligencia artificial": "ia",
      ia: "ia",
      ingles: "ingles",
      python: "python",
      "power bi": "powerbi",
      powerbi: "powerbi",
      "power-bi": "powerbi",
      excel: "excel",
      "excel basico": "excel",
      "excel intermediario": "excel",
      "excel avancado": "excel",
      "modelos de planilhas": "excel",
      uncategorized: "comunidade-impressionadora",
      "sem categoria": "comunidade-impressionadora",
      "dicas da hashtag": "comunidade-impressionadora",
      "treinamentos corporativos hashtag": "comunidade-impressionadora",
      "treinamentos-corporativos-hashtag": "comunidade-impressionadora",
      negocios: "comunidade-impressionadora",
      r: "comunidade-impressionadora",
      "no code": "comunidade-impressionadora",
      "no-code": "comunidade-impressionadora",
      "ciencia de dados": "ciencia-dados",
      "ciencia-dados": "ciencia-dados",
      javascript: "javascript",
      vba: "vba",
      sql: "sql",
      "html e css": "html-css",
      "html-css": "html-css",
      "power apps": "power-apps",
      "power-apps": "power-apps",
      powerpoint: "powerpoint",
      "power automate": "power-automate",
      "power-automate": "power-automate",
      "analise de dados": "analise-dados",
      "analise-dados": "analise-dados",
      "full stack": "full-stack",
      "full-stack": "full-stack",
      "front end": "front-end",
      "front-end": "front-end",
      n8n: "n8n",
      make: "make",
      flutterflow: "flutterflow",
    };

    if (componentBannerAliases[normalizedCategory]) {
      return componentBannerAliases[normalizedCategory];
    }

    if (categorySlug && componentBannerAliases[categorySlug]) {
      return componentBannerAliases[categorySlug];
    }

    return null;
  };

  // Resolve os dados de tracking do banner a partir da categoria do post.
  // O script antigo usava `categoria` para utm_campaign e `curso` para conversion.
  const resolveBannerTrackingConfig = (categoryText = "") => {
    const normalizedCategory = normalizeCategoryName(categoryText);
    const trackingAliases = {
      "inteligencia artificial": { curso: "ia", categoria: "treinamento" },
      ia: { curso: "ia", categoria: "treinamento" },
      ingles: { curso: "ing", categoria: "idioma" },
      python: { curso: "py", categoria: "programacao" },
      "power bi": { curso: "pbi", categoria: "treinamento" },
      powerbi: { curso: "pbi", categoria: "treinamento" },
      "power-bi": { curso: "pbi", categoria: "treinamento" },
      excel: { curso: "ex", categoria: "treinamento" },
      "excel basico": { curso: "ex", categoria: "treinamento" },
      "excel intermediario": { curso: "ex", categoria: "treinamento" },
      "excel avancado": { curso: "ex", categoria: "treinamento" },
      "modelos de planilhas": { curso: "ex", categoria: "treinamento" },
      uncategorized: { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "sem categoria": { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "dicas da hashtag": { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "treinamentos corporativos hashtag": { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "treinamentos-corporativos-hashtag": { curso: "comunidade-impressionadora", categoria: "treinamento" },
      negocios: { curso: "comunidade-impressionadora", categoria: "treinamento" },
      r: { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "no code": { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "no-code": { curso: "comunidade-impressionadora", categoria: "treinamento" },
      "ciencia de dados": { curso: "cd", categoria: "programacao" },
      "ciencia-dados": { curso: "cd", categoria: "programacao" },
      javascript: { curso: "js", categoria: "programacao" },
      vba: { curso: "vba", categoria: "treinamento" },
      sql: { curso: "sql", categoria: "programacao" },
      "html e css": { curso: "htmlcss", categoria: "programacao" },
      "html-css": { curso: "htmlcss", categoria: "programacao" },
      "power apps": { curso: "powerapps", categoria: "treinamento" },
      "power-apps": { curso: "powerapps", categoria: "treinamento" },
      powerpoint: { curso: "ppt", categoria: "treinamento" },
      "power automate": { curso: "pa", categoria: "treinamento" },
      "power-automate": { curso: "pa", categoria: "treinamento" },
      "analise de dados": { curso: "ad", categoria: "treinamento" },
      "analise-dados": { curso: "ad", categoria: "treinamento" },
    };

    if (trackingAliases[normalizedCategory]) {
      return trackingAliases[normalizedCategory];
    }

    const categorySlug = getCategorySlugFromLink();
    return trackingAliases[categorySlug] || null;
  };

  // Monta a URL final do CTA do banner incluindo os parametros de tracking do blog.
  const appendBannerTrackingParams = (button, trackingConfig) => {
    if (!button || !trackingConfig?.curso || !trackingConfig?.categoria) return;

    const url = new URL(button.getAttribute("href"), window.location.origin);

    url.searchParams.set("origemurl", `hashtag_site_org_blog_banner_${currentPostSlug}`);
    url.searchParams.set("utm_source", "site-org");
    url.searchParams.set("utm_medium", "blog-banner");
    url.searchParams.set("utm_campaign", trackingConfig.categoria);
    url.searchParams.set("utm_content", currentPostSlug);

    if (
      typeof dictTabelaLancamentos !== "undefined" &&
      typeof criarConversionLancamentoForm === "function" &&
      trackingConfig.curso in dictTabelaLancamentos
    ) {
      url.searchParams.set("conversion", criarConversionLancamentoForm(trackingConfig.curso));
    } else if (typeof criarConversionPerpetuoForm === "function") {
      url.searchParams.set("conversion", criarConversionPerpetuoForm(trackingConfig.curso));
    }

    button.setAttribute("href", url.toString());
  };

  // Aplica tracking no banner que ja foi renderizado pelo PHP dentro do artigo.
  const syncExistingCourseBannerTracking = () => {
    if (!content || !categoryLink) return;

    const trackingConfig = resolveBannerTrackingConfig(categoryLink.textContent);
    if (!trackingConfig) return;

    const existingBannerButton = content.querySelector(".cursos .botao");
    appendBannerTrackingParams(existingBannerButton, trackingConfig);
  };

  // Procura primeiro o slot fixo inserido pelo template. Sem ele, usa fallback no DOM.
  const resolveCourseBannerInsertionPoint = () => {
    if (!content) return null;

    const bannerSlot = content.querySelector("[data-course-banner-slot]");
    if (bannerSlot) {
      return bannerSlot;
    }

    const headings = [...content.querySelectorAll("h2")].filter(
      (heading) => heading.textContent.trim() !== ""
    );

    if (!headings.length) return null;

    return headings[1] || headings[2] || headings[0];
  };

  // Insere o banner original de cursos dentro do artigo usando o mesmo componente
  // da pagina de Todos os Cursos e priorizando o slot do template antes do segundo h2.
  const insertCourseBanner = (attempt = 0) => {
    if (!content || !categoryLink) return;
    if (content.querySelector("[data-course-banner='dynamic']")) return;

    const bannerSlug = resolveCourseBannerKey(categoryLink.textContent);
    if (!bannerSlug) return;

    const bannerWrapper = document.createElement("div");
    bannerWrapper.className = "cursos";
    bannerWrapper.setAttribute("data-course-banner", "dynamic");

    if (typeof window.criarBanner === "function") {
      bannerWrapper.innerHTML = window.criarBanner(bannerSlug);
    } else if (typeof window.adicionarBanners === "function") {
      window.adicionarBanners(bannerWrapper, [bannerSlug]);
    }

    if (!bannerWrapper.children.length) {
      if (attempt < 12) {
        window.setTimeout(() => insertCourseBanner(attempt + 1), 250);
      }
      return;
    }

    const bannerButton = bannerWrapper.querySelector(".botao");
    appendBannerTrackingParams(
      bannerButton,
      resolveBannerTrackingConfig(categoryLink.textContent)
    );

    const insertionHeading = resolveCourseBannerInsertionPoint();

    if (insertionHeading?.parentNode) {
      if (insertionHeading.matches?.("[data-course-banner-slot]")) {
        insertionHeading.replaceWith(bannerWrapper);
      } else {
        insertionHeading.insertAdjacentElement("beforebegin", bannerWrapper);
      }
      return;
    }

    if (attempt < 12) {
      window.setTimeout(() => insertCourseBanner(attempt + 1), 250);
      return;
    }

    content.appendChild(bannerWrapper);
  };

  // Monta o sumario lateral a partir dos h2/h3 do conteudo do artigo.
  const buildTOC = () => {
    if (!content || !toc || !tocWrapper) return;

    const isValidHeading = (heading) => {
      if (heading.textContent.trim() === "") return false;
      if (heading.closest(".wp-block-rank-math-toc-block")) return false;
      if (heading.closest(".cursos")) return false;
      if (heading.closest(".post__author")) return false;
      if (heading.classList.contains("post__toc-title")) return false;

      return true;
    };

    const headings = [...content.querySelectorAll("h2, h3, h4")].filter(isValidHeading);

    if (!headings.length) {
      const fallbackHeadings = [...document.querySelectorAll(".post__content h2, .post__content h3, .post__content h4")]
        .filter(isValidHeading);

      if (!fallbackHeadings.length) {
        tocWrapper.hidden = true;
        return;
      }

      fallbackHeadings.forEach((heading, index) => {
        let id = heading.id || slugify(heading.textContent) || `seccion-${index + 1}`;

        while (document.getElementById(id) && document.getElementById(id) !== heading) {
          id = `${id}-${index + 1}`;
        }

        heading.id = id;

        const li = document.createElement("li");
        const link = document.createElement("a");
        const level = heading.tagName.toLowerCase() === "h4" ? "3" : heading.tagName.toLowerCase() === "h3" ? "3" : "2";

        li.className = `post__toc-item post__toc-item--level-${level}`;
        link.className = "post__toc-link";
        link.href = `#${id}`;
        link.textContent = heading.textContent.trim();

        li.appendChild(link);
        toc.appendChild(li);
      });

      return;
    }

    const usedIds = new Set();

    headings.forEach((heading, index) => {
      let id = heading.id || slugify(heading.textContent) || `secao-${index + 1}`;

      while (usedIds.has(id)) {
        id = `${id}-${index + 1}`;
      }

      usedIds.add(id);
      heading.id = id;

      const li = document.createElement("li");
      const link = document.createElement("a");

      li.className = `post__toc-item post__toc-item--level-${heading.tagName.toLowerCase() === "h3" ? "3" : "2"}`;
      link.className = "post__toc-link";
      link.href = `#${id}`;
      link.textContent = heading.textContent.trim();

      li.appendChild(link);
      toc.appendChild(li);
    });

    const links = [...toc.querySelectorAll(".post__toc-link")];

    links.forEach((link) => {
      link.addEventListener("click", () => {
        links.forEach((item) => item.classList.remove("is-active"));
        link.classList.add("is-active");
      });
    });

    const observer = new IntersectionObserver(
      (entries) => {
        const visibleHeading = entries
          .filter((entry) => entry.isIntersecting)
          .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top)[0];

        if (!visibleHeading) return;

        links.forEach((link) => {
          const isCurrent = link.getAttribute("href") === `#${visibleHeading.target.id}`;
          link.classList.toggle("is-active", isCurrent);
        });
      },
      {
        rootMargin: "-20% 0px -65% 0px",
        threshold: [0, 1],
      }
    );

    headings.forEach((heading) => observer.observe(heading));

    if (links[0]) {
      links[0].classList.add("is-active");
    }
  };

  // Reduz spacers herdados do editor para evitar vazios exagerados no layout novo.
  const resizeSpacers = () => {
    const spacers = document.querySelectorAll(".post__text .wp-block-spacer");

    spacers.forEach((spacer) => {
      const height = spacer.clientHeight;

      if (height > 0) {
        spacer.style.height = `${Math.max(24, Math.round(height / 1.5))}px`;
      }
    });
  };

  // Agrupa embeds de formulario soltos em um wrapper padrao usado pelo layout do post.
  const wrapEmbeddedForms = () => {
    const forms = document.querySelectorAll(".post__text div[class^='_form_']");

    const getNextParagraph = (element) => {
      let next = element.nextElementSibling;

      while (next && next.tagName.toLowerCase() !== "p") {
        next = next.nextElementSibling;
      }

      return next;
    };

    forms.forEach((formWrapper) => {
      if (formWrapper.closest(".new-form-container")) return;

      const previous = formWrapper.previousElementSibling;
      const next = getNextParagraph(formWrapper);
      const newWrapper = document.createElement("div");

      newWrapper.className = "new-form-container";
      formWrapper.parentNode.insertBefore(newWrapper, formWrapper);

      if (previous && previous.tagName.toLowerCase() === "p") {
        newWrapper.appendChild(previous);
      }

      newWrapper.appendChild(formWrapper);

      if (next) {
        newWrapper.appendChild(next);
      }
    });
  };

  // Remove fundos inline indesejados de blocos de codigo/embed vindos do editor.
  const normalizeEmbeds = () => {
    const codeBlocks = document.querySelectorAll(".post__text .wp-block-code.has-background");

    codeBlocks.forEach((block) => {
      if (block.style.backgroundColor) {
        block.style.removeProperty("background-color");
      }
    });
  };

  // Limpa os embeds antigos de formulario e marca os elementos necessarios para estilizacao.
  const normalizeInlineForms = () => {
    const containers = document.querySelectorAll(
      ".post__text .new-form-container, .post__text [class^='container_form_'], .post__text [class*=' container_form_']"
    );

    containers.forEach((container) => {
      const centeredWrapper = container.querySelector("div[style*='text-align: center']");

      if (centeredWrapper) {
        centeredWrapper.removeAttribute("style");
        centeredWrapper.classList.add("post__form-shell");
      }

      container.querySelectorAll("link[rel='stylesheet'], style").forEach((node) => {
        if (
          node.tagName === "STYLE" ||
          (node.tagName === "LINK" && (node.getAttribute("href") || "").includes("fonts.googleapis.com"))
        ) {
          node.remove();
        }
      });

      const forms = container.querySelectorAll("form");

      forms.forEach((form) => {
        form.classList.add("post__embedded-form");

        const strayBreaks = form.querySelectorAll("br");
        strayBreaks.forEach((lineBreak) => {
          if (lineBreak.closest("button")) return;
          lineBreak.remove();
        });

        [...form.children].forEach((child) => {
          if (!(child instanceof HTMLElement)) return;
          if (child.matches("input[type='hidden'], ._form-content, ._form-thank-you")) return;

          const hasOnlyHiddenInputs =
            child.querySelectorAll("input").length > 0 &&
            [...child.querySelectorAll("input")].every((input) => input.type === "hidden");
          const hasVisibleText = (child.textContent || "").replace(/\u00a0/g, "").trim() !== "";

          if (child.tagName === "P" && (!hasVisibleText || hasOnlyHiddenInputs)) {
            child.remove();
          }
        });

        const closestLegacyContainer = form.closest("[class^='container_form_'], [class*=' container_form_']");
        if (closestLegacyContainer) {
          closestLegacyContainer.classList.add("post__legacy-form-container");
        }

        const content = form.querySelector("._form-content");
        if (!content) return;

        const elements = [...content.children];

        elements.forEach((element) => {
          if (!(element instanceof HTMLElement)) return;

          const hiddenInputs = [...element.querySelectorAll("input[type='hidden']")];
          const textInputs = [...element.querySelectorAll("input[type='text'], input[type='email'], textarea")];
          const button = element.querySelector("button._submit");
          const hasRenderableText = (element.textContent || "").replace(/\u00a0/g, "").trim() !== "";

          if (hiddenInputs.length && !textInputs.length && !button && !hasRenderableText) {
            element.classList.add("is-hidden-field");
            return;
          }

          if (hiddenInputs.length && !textInputs.length && !button) {
            element.classList.add("is-hidden-field");
            return;
          }

          if (textInputs.length) {
            element.classList.add("is-visible-field");
          }

          if (button) {
            element.classList.add("is-submit-field");
          }
        });
      });
    });
  };

  // Remove wrappers vazios que sobram de embeds malformados depois da normalizacao.
  const cleanupGhostFormWrappers = () => {
    const ghostWrappers = document.querySelectorAll(".post__text .new-form-container");

    const hasMeaningfulText = (element) =>
      (element.textContent || "")
        .replace(/\u00a0/g, "")
        .replace(/\s+/g, " ")
        .trim() !== "";

    ghostWrappers.forEach((wrapper) => {
      const visibleFields = wrapper.querySelectorAll(
        "input:not([type='hidden']), textarea, select, button, .is-visible-field, .is-submit-field"
      );
      const legalCopy = wrapper.querySelector("p, .has-text-align-center, [class^='texto_form_'], [class*=' texto_form_']");
      const visibleForm = wrapper.querySelector("form, [id^='_form_'], form[id^='form_']");
      const hasUsefulContent =
        visibleFields.length > 0 ||
        (legalCopy && hasMeaningfulText(legalCopy)) ||
        (visibleForm && hasMeaningfulText(visibleForm));

      if (hasUsefulContent) {
        wrapper.classList.remove("is-hidden-field");
        return;
      }

      wrapper.remove();
    });
  };

  if (shouldInjectRuntimeStyles()) {
    injectRuntimeStyles();
  }

  const safeRun = (callback) => {
    try {
      callback();
    } catch (error) {
      console.error("post-blog.js", error);
    }
  };

  // O banner precisa entrar mesmo se algum embed legado quebrar depois.
  safeRun(() => syncExistingCourseBannerTracking());
  safeRun(() => insertCourseBanner());
  safeRun(() => wrapEmbeddedForms());
  safeRun(() => normalizeEmbeds());
  safeRun(() => normalizeInlineForms());
  safeRun(() => cleanupGhostFormWrappers());
  safeRun(() => syncExistingCourseBannerTracking());
  safeRun(() => insertCourseBanner());
  window.addEventListener("load", () => {
    safeRun(() => syncExistingCourseBannerTracking());
    safeRun(() => insertCourseBanner());
  });
  safeRun(() => buildTOC());
  safeRun(() => resizeSpacers());
};

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initPostBlog);
} else {
  initPostBlog();
}
