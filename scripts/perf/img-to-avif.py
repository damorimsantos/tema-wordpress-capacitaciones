"""Gera .avif ao lado de cada .webp de uma pasta (mantem o .webp como fallback).
AVIF esmaga gradiente/glow (123KB webp -> 3KB avif) e reduz mockups/screenshots ~50-70%.
Depois trocar o src .webp -> .avif no template (decorativas alt="" podem ir src direto).

Requer: python -m pip install pillow pillow-avif-plugin
Uso: python scripts/perf/img-to-avif.py "<pasta de imgs>" [quality=68] [--only=luz]
  python scripts/perf/img-to-avif.py "desenvolvimento_hashtag/assets/imgs/Pagina de Inscricao Python" 68
"""
import os
import sys
from PIL import Image
import pillow_avif  # noqa: F401  (registra o encoder AVIF)

folder = sys.argv[1]
quality = int(sys.argv[2]) if len(sys.argv) > 2 and sys.argv[2].isdigit() else 68
only = next((a.split('=', 1)[1] for a in sys.argv if a.startswith('--only=')), '')

tb = ta = n = 0
for f in sorted(os.listdir(folder)):
    if not f.lower().endswith('.webp'):
        continue
    if only and only.lower() not in f.lower():
        continue
    src = os.path.join(folder, f)
    out = src[:-5] + '.avif'
    before = os.path.getsize(src)
    Image.open(src).convert('RGBA').save(out, 'AVIF', quality=quality)
    after = os.path.getsize(out)
    tb += before
    ta += after
    n += 1
    print(f'{f}: {before // 1024}KB -> {after // 1024}KB')

print(f'{n} imagens: {tb // 1024}KB -> {ta // 1024}KB (economia {(tb - ta) // 1024}KB)')
