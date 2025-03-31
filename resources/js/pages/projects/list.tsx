import {Head, Link, useForm} from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import { ColumnDef, flexRender, getCoreRowModel, useReactTable } from '@tanstack/react-table';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import {Badge} from "@/components/ui/badge";
import {CheckCircle2, CircleX, FilePenLine, MoreHorizontal} from "lucide-react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu";
import {Button} from "@/components/ui/button";
import {toast} from "sonner";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proyectos',
        href: '/projects',
    },
];

type Project = {
    id: string; // uuid
    name: string;
    start_date: string;
    status: string;
    responsible: string;
    amount: number; // float
};

type ProjectsProps = {
    projects: Project[];
};

function getProjectColumns({ handleDelete }: { handleDelete: (projectId: string) => void }): ColumnDef<Project>[] {
    return  [
        {
            accessorKey: 'name',
            header: 'Nombre',
            cell: ({ row }) => <div className="capitalize">{row.getValue('name')}</div>,
        },
        {
            accessorKey: 'start_date',
            header: 'Fecha de inicio',
            cell: ({ row }) => <div className="capitalize">{row.getValue('start_date')}</div>,
        },
        {
            accessorKey: "status",
            header: "Estado",
            cell: ({ row }) => (
                <Badge
                    variant="outline"
                    className="flex gap-1 px-1.5 text-muted-foreground [&_svg]:size-3"
                >
                    {row.original.status === "active" ? (
                        <CheckCircle2 className="text-green-500" />
                    ) : (
                        <CircleX className="text-red-500" />
                    )}
                    {row.original.status}
                </Badge>
            ),
        },
        {
            accessorKey: 'responsible',
            header: 'Responsable',
            cell: ({ row }) => <div className="capitalize">{row.getValue('responsible')}</div>,
        },
        {
            accessorKey: 'amount',
            header: 'Monto',
            cell: ({ row }) => <div className="capitalize">$ {row.getValue('amount')}</div>,
        },
        {
            id: "actions",
            enableHiding: false,
            cell: ({ row }) => {
                const payment = row.original

                return (
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button variant="ghost" className="h-8 w-8 p-0">
                                <span className="sr-only">Abrir menu</span>
                                <MoreHorizontal />
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuLabel className='font-bold'>
                                Acciones
                            </DropdownMenuLabel>
                            <Link href={route('projects.edit', payment.id)}>
                                <DropdownMenuItem>
                                    Editar
                                    <FilePenLine className="ml-auto h-4 w-4" />
                                </DropdownMenuItem>
                            </Link>
                            <DropdownMenuItem onClick={() => handleDelete(payment.id)}>
                                Eliminar
                                <CircleX className="ml-auto h-4 w-4" />
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                )
            },
        },
    ];
}

function Projects({ projects }: ProjectsProps) {
    const { delete: destroy } = useForm();

    const handleDelete = (projectId: string) => {
        destroy(route('projects.destroy', projectId), {
            onSuccess: () => {
                toast("Project deleted successfully", {
                    description: 'The project has been deleted successfully.',
                    duration: 5000,
                    action: {
                        label: 'Close',
                        onClick: () => toast.dismiss(),
                    },
                });
            },
        });
    };

    const table = useReactTable<Project>({
        state: {},
        data: projects,
        columns: getProjectColumns({ handleDelete }),
        getCoreRowModel: getCoreRowModel(),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Proyectos" />
            <div className="mx-4 mt-4">
                <Link href={route('projects.create')}>
                    <Button>Crear nuevo proyecto</Button>
                </Link>
            </div>
            <div className="rounded-md border m-4">
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id}>
                                {headerGroup.headers.map((header) => {
                                    return (
                                        <TableHead key={header.id}>
                                            {header.isPlaceholder ? null : flexRender(header.column.columnDef.header, header.getContext())}
                                        </TableHead>
                                    );
                                })}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow key={row.id} data-state={row.getIsSelected() && 'selected'}>
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>{flexRender(cell.column.columnDef.cell, cell.getContext())}</TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell colSpan={table.getAllColumns().length} className="h-24 text-center">
                                    No results.
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>
        </AppLayout>
    );
}

export default Projects;
