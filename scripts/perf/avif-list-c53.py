"""Converte uma LISTA de imagens (png/webp) -> .avif ao lado, com quality por item.
Preserva RGBA (alpha das luzes/glow). One-off pra C5.3 (landing excel-gratis da Cap).
"""
import os, sys
from PIL import Image
import pillow_avif  # noqa: F401

BASE = r"C:\Users\damor\Documents\ssh-sftp-wordpress-capacitaciones\wp-content\themes\hashtag\desenvolvimento_hashtag\assets\imgs"

# (rel_path, quality, maxdim)  maxdim=0 => sem resize. Luzes texturadas = shrink agressivo.
JOBS = [
    (r"Global\luz-hero.png", 54, 1100),          # above-fold, critica
    (r"Global\luz-aprender.png", 54, 1300),       # below-fold
    (r"Global\luz-diferenciais.png", 54, 1300),   # below-fold
    (r"Home\luz-ajudar.webp", 60, 0),
    (r"Home\luz-gratuitos.webp", 56, 1200),
    (r"Página Curso Excel Grátis\conjunto-hero.webp", 72, 0),     # hero img (conteudo)
    (r"Página Curso Excel Grátis\excel-IMPRESIONANTE.webp", 72, 0),
    (r"Global\luz-footer.webp", 56, 1200),
    (r"Página de Inscrição Inglês\luz-footer.png", 54, 1300),
]

tb = ta = 0
for rel, q, maxdim in JOBS:
    src = os.path.join(BASE, rel)
    if not os.path.exists(src):
        print(f"  MISSING: {rel}")
        continue
    root = os.path.splitext(src)[0]
    out = root + ".avif"
    im = Image.open(src).convert("RGBA")
    osz = im.size
    if maxdim and max(im.size) > maxdim:
        r = maxdim / max(im.size)
        im = im.resize((round(im.size[0]*r), round(im.size[1]*r)), Image.LANCZOS)
    im.save(out, "AVIF", quality=q)
    b, a = os.path.getsize(src), os.path.getsize(out)
    tb += b; ta += a
    note = f"{osz[0]}x{osz[1]}" + (f"->{im.size[0]}x{im.size[1]}" if im.size != osz else "")
    print(f"  {rel.split(chr(92))[-1]:32} {b//1024:>5}KB -> {a//1024:>4}KB  (q{q}, {note})")
print(f"\nTOTAL: {tb//1024}KB -> {ta//1024}KB  (economia {(tb-ta)//1024}KB / {100*(tb-ta)//tb}%)")
