"""Reconverte (com resize) os .avif acima de um limite, a partir do .webp/.png original.
Util para luzes/glows em alta-resolucao que ficam grandes mesmo em avif. Opera por pasta
(roda depois que o template ja aponta para .avif).

Requer: python -m pip install pillow pillow-avif-plugin
Uso: python scripts/perf/shrink-avif.py "<pasta>" [limite_kb=70] [max_dim=1400] [quality=55]
"""
import os
import sys
from PIL import Image
import pillow_avif  # noqa: F401

folder = sys.argv[1]
limit = (int(sys.argv[2]) if len(sys.argv) > 2 else 70) * 1024
max_dim = int(sys.argv[3]) if len(sys.argv) > 3 else 1400
quality = int(sys.argv[4]) if len(sys.argv) > 4 else 55

n = 0
for f in sorted(os.listdir(folder)):
    if not f.lower().endswith('.avif'):
        continue
    p = os.path.join(folder, f)
    if os.path.getsize(p) < limit:
        continue
    orig = next((p[:-5] + e for e in ('.webp', '.png', '.jpg', '.jpeg') if os.path.exists(p[:-5] + e)), None)
    if not orig:
        print(f'  (sem original p/ {f})')
        continue
    b = os.path.getsize(p)
    im = Image.open(orig).convert('RGBA')
    if max(im.size) > max_dim:
        im.thumbnail((max_dim, max_dim))
    im.save(p, 'AVIF', quality=quality)
    n += 1
    print(f'  {f}: {b // 1024}KB -> {os.path.getsize(p) // 1024}KB')
print(f'{n} avif reduzidas')
