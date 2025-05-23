PGDMP  7                    }            db_inventory    16.6    16.6     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    17781    db_inventory    DATABASE     �   CREATE DATABASE db_inventory WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE db_inventory;
                postgres    false            �            1259    17783    tb_inventory    TABLE     I  CREATE TABLE public.tb_inventory (
    id_barang integer NOT NULL,
    kode_barang character varying(20) NOT NULL,
    nama_barang character varying(50) NOT NULL,
    jumlah_barang integer NOT NULL,
    satuan_barang character varying(20) NOT NULL,
    harga_beli double precision NOT NULL,
    status_barang boolean NOT NULL
);
     DROP TABLE public.tb_inventory;
       public         heap    postgres    false            �            1259    17782    tb_inventory_id_barang_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_inventory_id_barang_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tb_inventory_id_barang_seq;
       public          postgres    false    216            �           0    0    tb_inventory_id_barang_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tb_inventory_id_barang_seq OWNED BY public.tb_inventory.id_barang;
          public          postgres    false    215            P           2604    17786    tb_inventory id_barang    DEFAULT     �   ALTER TABLE ONLY public.tb_inventory ALTER COLUMN id_barang SET DEFAULT nextval('public.tb_inventory_id_barang_seq'::regclass);
 E   ALTER TABLE public.tb_inventory ALTER COLUMN id_barang DROP DEFAULT;
       public          postgres    false    216    215    216            �          0    17783    tb_inventory 
   TABLE DATA           �   COPY public.tb_inventory (id_barang, kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang) FROM stdin;
    public          postgres    false    216   �       �           0    0    tb_inventory_id_barang_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tb_inventory_id_barang_seq', 21, true);
          public          postgres    false    215            R           2606    17790 )   tb_inventory tb_inventory_kode_barang_key 
   CONSTRAINT     k   ALTER TABLE ONLY public.tb_inventory
    ADD CONSTRAINT tb_inventory_kode_barang_key UNIQUE (kode_barang);
 S   ALTER TABLE ONLY public.tb_inventory DROP CONSTRAINT tb_inventory_kode_barang_key;
       public            postgres    false    216            T           2606    17788    tb_inventory tb_inventory_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.tb_inventory
    ADD CONSTRAINT tb_inventory_pkey PRIMARY KEY (id_barang);
 H   ALTER TABLE ONLY public.tb_inventory DROP CONSTRAINT tb_inventory_pkey;
       public            postgres    false    216            �   �   x�=�1r�0E�S�� �[;3.H��)ӈ�B6`� t�Rm���O��|܈,��:��^���u�w�o�1
��`v��Ƥq�!��~�ҩ@�C�@^}���q��'��,��h����!N��a�P��@�Z?�7���Z�X�8rr�r4"��oUɒ
�sb}�m�m��4r;}�ƈb�
*R��N7~�.�]S
U��}LO���t|�(�� �^Z     