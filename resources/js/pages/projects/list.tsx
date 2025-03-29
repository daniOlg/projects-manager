import {Head, Link, useForm} from "@inertiajs/react";
import AppLayout from "@/layouts/app-layout";
import type {BreadcrumbItem} from "@/types";
import {Button} from "@/components/ui/button";
import {toast} from "sonner";

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/components/ui/alert-dialog"

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Projects',
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
}

type ProjectsProps = {
    projects: Project[];
};

function Projects({ projects }: ProjectsProps) {
    const { delete : destroy } = useForm();

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

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Projects" />
            <div className="container mx-auto p-5">
                <table className="min-w-full table">
                    <thead>
                        <tr>
                            <th className="py-2 px-4 border-b">Name</th>
                            <th className="py-2 px-4 border-b">Start Date</th>
                            <th className="py-2 px-4 border-b">Status</th>
                            <th className="py-2 px-4 border-b">Responsible</th>
                            <th className="py-2 px-4 border-b">Amount</th>
                            <th className="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {projects.map((project: Project) => (
                            <tr key={project.id}>
                                <td className="py-2 px-4 border-b">{project.name}</td>
                                <td className="py-2 px-4 border-b">{project.start_date}</td>
                                <td className="py-2 px-4 border-b">{project.status}</td>
                                <td className="py-2 px-4 border-b">{project.responsible}</td>
                                <td className="py-2 px-4 border-b">{project.amount}</td>
                                <td className="py-2 px-4 border-b">
                                    <Link href={route('projects.edit', project.id)}>
                                        <Button className="mr-2">Edit</Button>
                                    </Link>
                                    <AlertDialog>
                                        <AlertDialogTrigger asChild>
                                            <Button variant="destructive">Delete</Button>
                                        </AlertDialogTrigger>
                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    This action cannot be undone. This will permanently delete the project.
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel>Cancel</AlertDialogCancel>
                                                <AlertDialogAction onClick={() => handleDelete(project.id)}>Delete</AlertDialogAction>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colSpan={6} className="py-2 px-4 border-b">
                                <Link href={route('projects.create')}>
                                    <Button>Create project</Button>
                                </Link>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </AppLayout>
    );
}

export default Projects;
